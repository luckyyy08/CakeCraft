<?php 
include "includes/header.php"; 

// Default values
$selected_month = isset($_GET['month']) ? intval($_GET['month']) : date('m');
$selected_year = isset($_GET['year']) ? intval($_GET['year']) : date('Y');
$selected_date = isset($_GET['date']) ? $_GET['date'] : date('Y-m-d');
$report_type = isset($_GET['type']) ? $_GET['type'] : 'monthly';

// Query logic based on report type
if($report_type == 'yearly') {
    $where_clause = "YEAR(order_date) = '$selected_year'";
    $title_period = $selected_year;
} elseif($report_type == 'daily') {
    $where_clause = "DATE(order_date) = '$selected_date'";
    $title_period = date("d M Y", strtotime($selected_date));
} else {
    $where_clause = "YEAR(order_date) = '$selected_year' AND MONTH(order_date) = '$selected_month'";
    $title_period = date("F", mktime(0, 0, 0, $selected_month, 10)) . " " . $selected_year;
}

// Summary Stats
$q_stats = mysqli_query($conn, "SELECT count(*) as total_orders, sum(total_price) as total_revenue FROM orders WHERE $where_clause AND payment_status='Paid'");
$r_stats = mysqli_fetch_assoc($q_stats);
$total_orders = $r_stats['total_orders'] ?? 0;
$total_rev = $r_stats['total_revenue'] ?? 0;

// Detailed Orders
$q_orders = mysqli_query($conn, "SELECT o.*, u.fullname FROM orders o LEFT JOIN users u ON o.user_id = u.id WHERE $where_clause ORDER BY o.order_date DESC");

// Top Selling Products (Selected Period)
$q_top_products = mysqli_query($conn, "SELECT item_id, item_type, SUM(quantity) as total_sold, SUM(quantity * price) as revenue
                                        FROM order_items 
                                        WHERE order_id IN (SELECT id FROM orders WHERE $where_clause AND payment_status='Paid')
                                        GROUP BY item_id, item_type 
                                        ORDER BY total_sold DESC 
                                        LIMIT 5");

// Category Performance (Selected Period)
// 1. Cakes by Category
$q_cake_categories = mysqli_query($conn, "SELECT c.name, SUM(oi.quantity * oi.price) as revenue
                                            FROM order_items oi
                                            JOIN cakes k ON oi.item_id = k.id AND oi.item_type = 'cake'
                                            JOIN categories c ON k.category_id = c.id
                                            WHERE oi.order_id IN (SELECT id FROM orders WHERE $where_clause AND payment_status='Paid')
                                            GROUP BY c.id");

// 2. Other Types
$q_other_types = mysqli_query($conn, "SELECT item_type as name, SUM(quantity * price) as revenue
                                        FROM order_items
                                        WHERE item_type != 'cake' AND order_id IN (SELECT id FROM orders WHERE $where_clause AND payment_status='Paid')
                                        GROUP BY item_type");
?>

<div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:20px;">
    <h1 class="page-title">Sales Reports</h1>
    <div style="display:flex; gap:10px;">
        <button onclick="window.print()" class="btn btn-info" style="background:#34495e; border:none; color:white; padding:8px 15px; border-radius:4px; cursor:pointer;"><i class="fa-solid fa-print"></i> Print Report</button>
    </div>
</div>

<!-- Overall Overview (Lifetime) -->
<?php 
$q_overall = mysqli_query($conn, "SELECT count(*) as total_orders, sum(total_price) as total_revenue FROM orders WHERE payment_status='Paid'");
$r_overall = mysqli_fetch_assoc($q_overall);
?>
<div style="background: linear-gradient(135deg, #1e293b 0%, #334155 100%); padding: 25px; border-radius: 12px; color: white; margin-bottom: 30px; display: flex; justify-content: space-around; align-items: center; box-shadow: 0 10px 25px rgba(0,0,0,0.1);">
    <div style="text-align: center; border-right: 1px solid rgba(255,255,255,0.1); padding: 0 40px;">
        <p style="font-size: 14px; text-transform: uppercase; letter-spacing: 1px; opacity: 0.8; margin-bottom: 5px;">Lifetime Orders</p>
        <h2 style="font-size: 32px; margin: 0;"><?php echo $r_overall['total_orders']; ?></h2>
    </div>
    <div style="text-align: center; padding: 0 40px;">
        <p style="font-size: 14px; text-transform: uppercase; letter-spacing: 1px; opacity: 0.8; margin-bottom: 5px;">Lifetime Revenue</p>
        <h2 style="font-size: 32px; margin: 0; color: #fbbf24;">₹ <?php echo number_format($r_overall['total_revenue'] ?? 0, 2); ?></h2>
    </div>
</div>

<!-- Filters -->
<div class="card" style="margin-bottom:25px; background: #fff; border: 1px solid #e2e8f0; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05);">
    <h3 style="margin: 0 0 15px 0; font-size: 16px; color: #64748b;"><i class="fa-solid fa-filter"></i> Report Filters</h3>
    <form method="GET" action="reports.php" style="display:flex; gap:20px; align-items:flex-end; flex-wrap:wrap;">
        <div style="flex:1; min-width:150px;">
            <label style="display:block; margin-bottom:8px; font-weight:600; color:#475569; font-size:13px; text-transform: uppercase;">Report Type</label>
            <select name="type" class="form-control" style="width:100%; padding:10px; border-radius:6px; border:1px solid #cbd5e1; font-weight: 500;" onchange="toggleFilters(this.value)">
                <option value="daily" <?php echo $report_type == 'daily' ? 'selected' : ''; ?>>Daily Report</option>
                <option value="monthly" <?php echo $report_type == 'monthly' ? 'selected' : ''; ?>>Monthly Report</option>
                <option value="yearly" <?php echo $report_type == 'yearly' ? 'selected' : ''; ?>>Yearly Report</option>
            </select>
        </div>

        <div id="date-select" style="flex:1; min-width:150px; <?php echo $report_type != 'daily' ? 'display:none;' : ''; ?>">
            <label style="display:block; margin-bottom:8px; font-weight:600; color:#475569; font-size:13px; text-transform: uppercase;">Select Date</label>
            <input type="date" name="date" value="<?php echo $selected_date; ?>" class="form-control" style="width:100%; padding:10px; border-radius:6px; border:1px solid #cbd5e1; font-weight: 500;">
        </div>

        <div id="month-select" style="flex:1; min-width:150px; <?php echo $report_type != 'monthly' ? 'display:none;' : ''; ?>">
            <label style="display:block; margin-bottom:8px; font-weight:600; color:#475569; font-size:13px; text-transform: uppercase;">Select Month</label>
            <select name="month" class="form-control" style="width:100%; padding:10px; border-radius:6px; border:1px solid #cbd5e1; font-weight: 500;">
                <?php for($m=1; $m<=12; $m++): ?>
                    <option value="<?php echo $m; ?>" <?php echo $selected_month == $m ? 'selected' : ''; ?>>
                        <?php echo date("F", mktime(0, 0, 0, $m, 10)); ?>
                    </option>
                <?php endfor; ?>
            </select>
        </div>

        <div id="year-select" style="flex:1; min-width:150px; <?php echo ($report_type == 'daily') ? 'display:none;' : ''; ?>">
            <label style="display:block; margin-bottom:8px; font-weight:600; color:#475569; font-size:13px; text-transform: uppercase;">Select Year</label>
            <select name="year" class="form-control" style="width:100%; padding:10px; border-radius:6px; border:1px solid #cbd5e1; font-weight: 500;">
                <?php 
                $start_year = 2024;
                $current_y = date('Y');
                for($y=$current_y; $y>=$start_year; $y--): ?>
                    <option value="<?php echo $y; ?>" <?php echo $selected_year == $y ? 'selected' : ''; ?>><?php echo $y; ?></option>
                <?php endfor; ?>
            </select>
        </div>

        <button type="submit" class="btn btn-primary" style="padding:12px 30px; background:#e67e22; border:none; color:white; border-radius:6px; font-weight:700; cursor:pointer; text-transform: uppercase; letter-spacing: 0.5px; transition: 0.3s; box-shadow: 0 4px 10px rgba(230, 126, 34, 0.3);">
            <i class="fa-solid fa-magnifying-glass"></i> Filter Report
        </button>
    </form>
</div>

<!-- Stats for Selected Period -->
<div style="margin-bottom: 20px;">
    <h3 style="font-size: 14px; text-transform: uppercase; color: #94a3b8; letter-spacing: 1px;">Showing Statistics for: <span style="color: #334155;"><?php echo $title_period; ?></span></h3>
</div>
<div class="stat-cards" style="display:grid; grid-template-columns: repeat(auto-fit, minmax(240px, 1fr)); gap:20px; margin-bottom:30px;">
    <div class="stat-card" style="border-left: 5px solid #3498db; background: #fff; padding: 25px;">
        <div class="stat-info">
            <p style="color:#64748b; margin-bottom:8px; font-weight:600; font-size: 13px; text-transform: uppercase;">Orders in Period</p>
            <h3 style="font-size:32px; color:#1e293b; margin: 0;"><?php echo $total_orders; ?></h3>
        </div>
        <div class="stat-icon" style="background: rgba(52, 152, 219, 0.1); width: 60px; height: 60px; border-radius: 50%; display: flex; align-items: center; justify-content: center;">
            <i class="fa-solid fa-cart-shopping" style="color:#3498db; font-size:24px;"></i>
        </div>
    </div>
    <div class="stat-card" style="border-left: 5px solid #10b981; background: #fff; padding: 25px;">
        <div class="stat-info">
            <p style="color:#64748b; margin-bottom:8px; font-weight:600; font-size: 13px; text-transform: uppercase;">Revenue in Period</p>
            <h3 style="font-size:32px; color:#1e293b; margin: 0;">₹ <?php echo number_format($total_rev, 2); ?></h3>
        </div>
        <div class="stat-icon" style="background: rgba(16, 185, 129, 0.1); width: 60px; height: 60px; border-radius: 50%; display: flex; align-items: center; justify-content: center;">
            <i class="fa-solid fa-indian-rupee-sign" style="color:#10b981; font-size:24px;"></i>
        </div>
    </div>
</div>

<!-- Results Table -->
<div class="card">
    <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:20px; border-bottom:2px solid #f1f5f9; padding-bottom:15px;">
        <h2 style="font-size:18px; color:#334155; margin:0;">Detailed Sales: <span style="color:#e67e22;"><?php echo $title_period; ?></span></h2>
    </div>
    <table class="admin-table">
        <thead>
            <tr>
                <th>Order ID</th>
                <th>Customer Name</th>
                <th>Order Date</th>
                <th>Amount</th>
                <th>Status</th>
                <th>Payment</th>
            </tr>
        </thead>
        <tbody>
            <?php if(mysqli_num_rows($q_orders) > 0): ?>
                <?php while($ord = mysqli_fetch_assoc($q_orders)): ?>
                    <tr>
                        <td><strong>#ORD-<?php echo str_pad($ord['id'], 4, '0', STR_PAD_LEFT); ?></strong></td>
                        <td><?php echo htmlspecialchars($ord['fullname']); ?></td>
                        <td><?php echo date('d M Y', strtotime($ord['order_date'])); ?></td>
                        <td>₹ <?php echo number_format($ord['total_price'], 2); ?></td>
                        <td>
                            <span class="badge" style="background:<?php echo $ord['order_status']=='Delivered' ? '#dcfce7' : '#fef9c3'; ?>; color:<?php echo $ord['order_status']=='Delivered' ? '#15803d' : '#a16207'; ?>; padding:5px 10px; border-radius:20px; font-size:12px; font-weight:600;">
                                <?php echo htmlspecialchars($ord['order_status']); ?>
                            </span>
                        </td>
                        <td>
                             <span class="badge" style="background:<?php echo $ord['payment_status']=='Paid' ? '#dcfce7' : '#fee2e2'; ?>; color:<?php echo $ord['payment_status']=='Paid' ? '#15803d' : '#b91c1c'; ?>; padding:5px 10px; border-radius:20px; font-size:12px; font-weight:600;">
                                <?php echo htmlspecialchars($ord['payment_status']); ?>
                            </span>
                        </td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr>
                    <td colspan="6" style="text-align:center; padding:40px; color:#94a3b8;">No orders found for the selected period.</td>
                </tr>
            <?php endif; ?>
        </tbody>
        <?php if(mysqli_num_rows($q_orders) > 0): ?>
        <tfoot>
            <tr style="background: #f8fafc; font-weight: bold; border-top: 2px solid #e2e8f0;">
                <td colspan="3" style="text-align: right; padding: 15px; color: #475569;">TOTAL FOR THIS PERIOD:</td>
                <td style="padding: 15px; color: #e67e22; font-size: 18px;">₹ <?php echo number_format($total_rev, 2); ?></td>
                <td colspan="2" style="font-size: 12px; color: #94a3b8; font-weight: normal; vertical-align: middle;">(Based on Paid Orders)</td>
            </tr>
        </tfoot>
        <?php endif; ?>
    </table>
</div>

<!-- Extra Analytics Section -->
<div style="display: grid; grid-template-columns: 1fr 1fr; gap: 30px; margin-top: 30px; margin-bottom: 50px;">
    
    <!-- Top Selling Products -->
    <div class="card" style="margin:0;">
        <h3 style="font-size:18px; color:#334155; margin-bottom:20px; border-bottom:1px solid #f1f5f9; padding-bottom:10px;">
            <i class="fa-solid fa-crown" style="color:#fbbf24;"></i> Top 5 Bestsellers (<?php echo $title_period; ?>)
        </h3>
        <div style="display:flex; flex-direction:column; gap:15px;">
            <?php if(mysqli_num_rows($q_top_products) > 0): ?>
                <?php while($tp = mysqli_fetch_assoc($q_top_products)): 
                    $p_id = $tp['item_id'];
                    $p_type = $tp['item_type'];
                    $p_name = "Unknown Product";
                    if($p_type == 'cake') $res_p = mysqli_query($conn, "SELECT name FROM cakes WHERE id=$p_id");
                    elseif($p_type == 'candle') $res_p = mysqli_query($conn, "SELECT name FROM candles WHERE id=$p_id");
                    elseif($p_type == 'hamper') $res_p = mysqli_query($conn, "SELECT name FROM hampers WHERE id=$p_id");
                    elseif($p_type == 'decoration') $res_p = mysqli_query($conn, "SELECT name FROM decorations WHERE id=$p_id");
                    
                    if($p_data = mysqli_fetch_assoc($res_p)) $p_name = $p_data['name'];
                ?>
                <div style="display:flex; align-items:center; justify-content:space-between; padding:12px; background:#f8fafc; border-radius:8px; border:1px solid #e2e8f0;">
                    <div style="display:flex; align-items:center; gap:12px;">
                        <span style="background:#e67e22; color:white; width:24px; height:24px; border-radius:50%; display:flex; align-items:center; justify-content:center; font-size:12px; font-weight:700;"><?php echo $tp['total_sold']; ?></span>
                        <div style="line-height:1.2;">
                            <span style="font-weight:600; color:#1e293b; font-size:14px;"><?php echo htmlspecialchars($p_name); ?></span><br>
                            <small style="color:#64748b; text-transform:uppercase; font-size:10px;"><?php echo $p_type; ?></small>
                        </div>
                    </div>
                    <div style="text-align:right;">
                        <span style="font-weight:700; color:#10b981; font-size:14px;">₹ <?php echo number_format($tp['revenue'], 2); ?></span>
                    </div>
                </div>
                <?php endwhile; ?>
            <?php else: ?>
                <p style="text-align:center; padding:30px; color:#94a3b8;">No product data available.</p>
            <?php endif; ?>
        </div>
    </div>

    <!-- Category Performance -->
    <div class="card" style="margin:0;">
        <h3 style="font-size:18px; color:#334155; margin-bottom:20px; border-bottom:1px solid #f1f5f9; padding-bottom:10px;">
            <i class="fa-solid fa-chart-pie" style="color:#3498db;"></i> Revenue by Category
        </h3>
        <div style="display:flex; flex-direction:column; gap:20px;">
            <?php 
            $all_cats = [];
            while($cat = mysqli_fetch_assoc($q_cake_categories)) $all_cats[] = $cat;
            while($type = mysqli_fetch_assoc($q_other_types)) $all_cats[] = $type;
            
            if(count($all_cats) > 0):
                // Find max revenue for progress bar scaling
                $max_rev = 0;
                foreach($all_cats as $c) if($c['revenue'] > $max_rev) $max_rev = $c['revenue'];
                
                foreach($all_cats as $c): 
                    $percent = ($max_rev > 0) ? ($c['revenue'] / $max_rev) * 100 : 0;
            ?>
                <div>
                    <div style="display:flex; justify-content:space-between; margin-bottom:8px; font-size:13px; font-weight:600; color:#475569;">
                        <span><?php echo htmlspecialchars(ucfirst($c['name'])); ?></span>
                        <span style="color:#e67e22;">₹ <?php echo number_format($c['revenue'], 2); ?></span>
                    </div>
                    <div style="width:100%; height:8px; background:#f1f5f9; border-radius:10px; overflow:hidden;">
                        <div style="width:<?php echo $percent; ?>%; height:100%; background:linear-gradient(90deg, #3498db, #2ecc71); border-radius:10px;"></div>
                    </div>
                </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p style="text-align:center; padding:30px; color:#94a3b8;">No category data available.</p>
            <?php endif; ?>
        </div>
    </div>

</div>

<script>
function toggleFilters(val) {
    var dateDiv = document.getElementById('date-select');
    var monthDiv = document.getElementById('month-select');
    var yearDiv = document.getElementById('year-select');
    
    // Hide all first
    dateDiv.style.display = 'none';
    monthDiv.style.display = 'none';
    yearDiv.style.display = 'none';
    
    if(val == 'daily') {
        dateDiv.style.display = 'block';
    } else if(val == 'monthly') {
        monthDiv.style.display = 'block';
        yearDiv.style.display = 'block';
    } else if(val == 'yearly') {
        yearDiv.style.display = 'block';
    }
}
</script>

<?php include "includes/footer.php"; ?>
