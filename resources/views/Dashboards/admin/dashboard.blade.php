<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sept11Barber Shop</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            padding: 20px;
        }

        .dashboard {
            max-width: 1200px;
            margin: 0 auto;
            background: white;
            border-radius: 20px;
            box-shadow: 0 20px 40px rgba(0,0,0,0.1);
            overflow: hidden;
        }

        .header {
            background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 100%);
            color: white;
            padding: 30px;
            text-align: center;
        }

        .header h1 {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 10px;
        }

        .stats {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 15px;
            margin: 20px 0;
        }

        .stat-card {
            background: rgba(255,255,255,0.2);
            padding: 20px;
            border-radius: 15px;
            text-align: center;
            backdrop-filter: blur(10px);
        }

        .stat-number {
            font-size: 2rem;
            font-weight: bold;
            display: block;
        }

        .controls {
            padding: 30px;
            background: #f8fafc;
            border-bottom: 1px solid #e2e8f0;
        }

        .search-filter {
            display: grid;
            grid-template-columns: 2fr 1fr 1fr;
            gap: 20px;
            margin-bottom: 20px;
        }

        .input-group {
            position: relative;
        }

        .input-group input, .input-group select {
            width: 100%;
            padding: 15px 20px;
            border: 2px solid #e2e8f0;
            border-radius: 12px;
            font-size: 16px;
            transition: all 0.3s ease;
            background: white;
        }

        .input-group input:focus, .input-group select:focus {
            outline: none;
            border-color: #4f46e5;
            box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.1);
        }

        .action-buttons {
            display: flex;
            gap: 15px;
            flex-wrap: wrap;
        }

        .btn {
            padding: 12px 24px;
            border: none;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .btn-primary {
            background: #4f46e5;
            color: white;
        }

        .btn-primary:hover {
            background: #4338ca;
            transform: translateY(-2px);
        }

        .btn-success {
            background: #10b981;
            color: white;
        }

        .btn-success:hover {
            background: #059669;
            transform: translateY(-2px);
        }

        .btn-danger {
            background: #ef4444;
            color: white;
        }

        .btn-danger:hover {
            background: #dc2626;
            transform: translateY(-2px);
        }

        .table-container {
            padding: 0 30px 30px 30px;
            overflow-x: auto;
        }

        .booking-table {
            width: 100%;
            border-collapse: collapse;
            background: white;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 6px rgba(0,0,0,0.05);
        }

        .booking-table th {
            background: linear-gradient(135deg, #1e293b 0%, #334155 100%);
            color: white;
            padding: 20px 15px;
            text-align: left;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            font-size: 12px;
        }

        .booking-table td {
            padding: 18px 15px;
            border-bottom: 1px solid #f1f5f9;
            vertical-align: middle;
        }

        .booking-table tbody tr {
            transition: all 0.3s ease;
        }

        .booking-table tbody tr:hover {
            background: #f8fafc;
            transform: scale(1.01);
        }

        .status-badge {
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .status-pending {
            background: #fef3c7;
            color: #92400e;
        }

        .status-confirmed {
            background: #d1fae5;
            color: #065f46;
        }

        .status-completed {
            background: #dbeafe;
            color: #1e40af;
        }

        .status-cancelled {
            background: #fee2e2;
            color: #991b1b;
        }

        .approval-buttons {
            display: flex;
            gap: 8px;
            flex-wrap: wrap;
        }

        .accept-btn, .reject-btn {
            padding: 8px 16px;
            text-decoration: none;
            border-radius: 6px;
            font-size: 12px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            transition: all 0.3s ease;
            display: inline-block;
            text-align: center;
        }

        .accept-btn {
            background: #10b981;
            color: white;
        }

        .accept-btn:hover {
            background: #059669;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(16, 185, 129, 0.3);
        }

        .reject-btn {
            background: #ef4444;
            color: white;
        }

        .reject-btn:hover {
            background: #dc2626;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(239, 68, 68, 0.3);
        }

        /* Additional status badge styles for your booking statuses */
        .status-accepted {
            background: #d1fae5;
            color: #065f46;
        }

        .status-rejected {
            background: #fee2e2;
            color: #991b1b;
        }

        .empty-state {
            text-align: center;
            padding: 60px 20px;
            color: #64748b;
        }

        .empty-state h3 {
            font-size: 1.5rem;
            margin-bottom: 10px;
        }

        @media (max-width: 768px) {
            .search-filter {
                grid-template-columns: 1fr;
            }
            
            .action-buttons {
                justify-content: center;
            }
            
            .booking-table {
                font-size: 14px;
            }
            
            .booking-table th,
            .booking-table td {
                padding: 12px 8px;
            }
        }

        .notification {
            position: fixed;
            top: 20px;
            right: 20px;
            padding: 15px 25px;
            border-radius: 8px;
            color: white;
            font-weight: 600;
            z-index: 1000;
            transform: translateX(400px);
            transition: transform 0.3s ease;
        }

        .notification.show {
            transform: translateX(0);
        }

        .notification.success {
            background: #10b981;
        }

        .notification.error {
            background: #ef4444;
        }

        .header-logo {
            max-width: 350px; /* Adjust size as needed */
            height: auto;
            display: block;
            margin: 0 auto 15px auto;
        }
        @media (max-width: 768px) {
        .header-logo {
            max-width: 300px; /* Smaller logo on mobile */
        }
    }
    </style>
</head>
<body>
    <div class="dashboard">
       <div class="header">
    <img src="/build/assets/logo2.png" alt="Sept11Barber Shop Logo" class="header-logo">
    <h1>Booking Dashboard</h1>
    <div class="stats">
        <div class="stat-card">
            <span class="stat-number" id="totalBookings">0</span>
            <span>Total Bookings</span>
        </div>
        <div class="stat-card">
            <span class="stat-number" id="todayBookings">0</span>
            <span>Today's Bookings</span>
        </div>
        <div class="stat-card">
            <span class="stat-number" id="pendingBookings">0</span>
            <span>Pending</span>
        </div>
        <div class="stat-card">
            <span class="stat-number" id="confirmedBookings">0</span>
            <span>Confirmed</span>
        </div>
    </div>
</div>

        <div class="controls">
            <div class="search-filter">
                <div class="input-group">
                    <input type="text" id="searchInput" placeholder="Search by name, phone, or service..." onkeyup="filterTable()">
                </div>
                <div class="input-group">
                    <select id="statusFilter" onchange="filterTable()">
                        <option value="">All Status</option>
                        <option value="pending">Pending</option>
                        <option value="accepted">Accepted</option>
                        <option value="rejected">Rejected</option>
                    </select>
                </div>
                <div class="input-group">
                    <input type="date" id="dateFilter" onchange="filterTable()">
                </div>
            </div>
            
            <div class="action-buttons">
                <button class="btn btn-primary" onclick="window.location.reload()">🔄 Refresh</button>
                <button class="btn btn-success" onclick="exportTableToCSV()">📥 Export CSV</button>
                <button class="btn btn-danger" onclick="clearFilters()">🗑️ Clear Filters</button>
            </div>
        </div>

        <div class="table-container">
            <table class="booking-table">
                <thead>
                    <tr>
                        <th>Booking No.</th>
                        <th>Name</th>
                        <th>Phone No.</th>
                        <th>Date</th>
                        <th>Time</th>
                        <th>Service</th>
                        <th>Status</th>
                        <th>Approval</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($bookings as $booking)
                        <tr>
                            <td><strong>{{ $booking->booking_number }}</strong></td>
                            <td>{{ $booking->booking_name }}</td>
                            <td>{{ $booking->booking_phonenumber }}</td>
                            <td>{{ $booking->booking_date }}</td>
                            <td>{{ $booking->booking_time }}</td>
                            <td>{{ $booking->booking_service }}</td>
                            <td>
                                <span class="status-badge status-{{ strtolower($booking->booking_status) }}">
                                    {{ $booking->booking_status }}
                                </span>
                            </td>
                            <td>
                                <div class="approval-buttons">
                                    <a href="{{ route('accept.booking', $booking->id)}}" class="accept-btn">Accept</a>
                                    <a href="{{ route('reject.booking', $booking->id)}}" class="reject-btn">Reject</a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div id="notification" class="notification"></div>

    <script>
        // Filter table functionality for backend-rendered data
        function filterTable() {
            const searchInput = document.getElementById('searchInput').value.toLowerCase();
            const statusFilter = document.getElementById('statusFilter').value.toLowerCase();
            const dateFilter = document.getElementById('dateFilter').value;
            const table = document.querySelector('.booking-table tbody');
            const rows = table.querySelectorAll('tr');
            
            let visibleCount = 0;
            
            rows.forEach(row => {
                const cells = row.querySelectorAll('td');
                if (cells.length === 0) return; // Skip if no cells
                
                const name = cells[1].textContent.toLowerCase();
                const phone = cells[2].textContent.toLowerCase();
                const service = cells[5].textContent.toLowerCase();
                const status = cells[6].textContent.toLowerCase().trim();
                const date = cells[3].textContent;
                
                const matchesSearch = !searchInput || 
                    name.includes(searchInput) || 
                    phone.includes(searchInput) || 
                    service.includes(searchInput);
                
                const matchesStatus = !statusFilter || status.includes(statusFilter);
                
                const matchesDate = !dateFilter || date.includes(dateFilter);
                
                if (matchesSearch && matchesStatus && matchesDate) {
                    row.style.display = '';
                    visibleCount++;
                } else {
                    row.style.display = 'none';
                }
            });
            
            // Show/hide empty state
            const emptyState = document.getElementById('emptyState');
            if (emptyState) {
                emptyState.style.display = visibleCount === 0 ? 'block' : 'none';
            }
            
            updateVisibleStats(visibleCount);
        }
        
        function updateVisibleStats(visibleCount) {
            // Update stats based on visible bookings
            const table = document.querySelector('.booking-table tbody');
            const visibleRows = Array.from(table.querySelectorAll('tr')).filter(row => 
                row.style.display !== 'none' && row.querySelectorAll('td').length > 0
            );
            
            const today = new Date().toISOString().split('T')[0];
            let todayCount = 0;
            let pendingCount = 0;
            let confirmedCount = 0;
            
            visibleRows.forEach(row => {
                const cells = row.querySelectorAll('td');
                const date = cells[3].textContent;
                const status = cells[6].textContent.toLowerCase().trim();
                
                if (date.includes(today)) todayCount++;
                if (status.includes('pending')) pendingCount++;
                if (status.includes('confirmed') || status.includes('accepted')) confirmedCount++;
            });
            
            document.getElementById('totalBookings').textContent = visibleCount;
            document.getElementById('todayBookings').textContent = todayCount;
            document.getElementById('pendingBookings').textContent = pendingCount;
            document.getElementById('confirmedBookings').textContent = confirmedCount;
        }
        
        function clearFilters() {
            document.getElementById('searchInput').value = '';
            document.getElementById('statusFilter').value = '';
            document.getElementById('dateFilter').value = '';
            filterTable();
            showNotification('Filters cleared', 'success');
        }
        
        function exportTableToCSV() {
            const table = document.querySelector('.booking-table');
            const rows = Array.from(table.querySelectorAll('tr')).filter(row => 
                row.style.display !== 'none'
            );
            
            let csvContent = '';
            
            rows.forEach(row => {
                const cells = Array.from(row.querySelectorAll('th, td'));
                const rowData = cells.map(cell => {
                    // Clean up cell content, remove HTML
                    let text = cell.textContent.trim();
                    // Handle approval buttons column
                    if (cell.querySelector('.approval-buttons')) {
                        text = 'Pending Approval';
                    }
                    return `"${text}"`;
                }).join(',');
                csvContent += rowData + '\n';
            });
            
            const blob = new Blob([csvContent], { type: 'text/csv' });
            const url = URL.createObjectURL(blob);
            const a = document.createElement('a');
            a.href = url;
            a.download = 'bookings_' + new Date().toISOString().split('T')[0] + '.csv';
            document.body.appendChild(a);
            a.click();
            document.body.removeChild(a);
            URL.revokeObjectURL(url);
            
            showNotification('Bookings exported successfully!', 'success');
        }
        
        function showNotification(message, type) {
            const notification = document.getElementById('notification');
            notification.textContent = message;
            notification.className = `notification ${type}`;
            notification.classList.add('show');
            
            setTimeout(() => {
                notification.classList.remove('show');
            }, 3000);
        }
        
        // Initialize stats when page loads
        function initializeDashboard() {
            const table = document.querySelector('.booking-table tbody');
            const allRows = table.querySelectorAll('tr');
            updateVisibleStats(allRows.length);
        }
        
        // Add empty state div if it doesn't exist
        function addEmptyState() {
            const tableContainer = document.querySelector('.table-container');
            if (!document.getElementById('emptyState')) {
                const emptyState = document.createElement('div');
                emptyState.id = 'emptyState';
                emptyState.className = 'empty-state';
                emptyState.style.display = 'none';
                emptyState.innerHTML = `
                    <h3>No bookings found</h3>
                    <p>Try adjusting your search criteria.</p>
                `;
                tableContainer.appendChild(emptyState);
            }
        }
        
        // Initialize when page loads
        document.addEventListener('DOMContentLoaded', function() {
            addEmptyState();
            initializeDashboard();
        });
    </script>
</body>
</html>