@extends('business.layouts.app')
@section('title')
Quick India | Coin History
@endsection 
@section('keyword')
Find Best It Training Centre near You, Find Best It Training Institute near You, Find Top 10 IT Training Institute near You, Find Best Entrance Exam Preparation Centre Near you, Top 10 Entrance Exam Centre Near you, Find Best Distance Education Centre Near You, Find Top 10 Distance Education Centre Near You, Find Best School And Colleges Near You, Find Top 10 school And College Near You, Get Education Loan, GET Free career Counselling, Find Best overseas education consultants Near you, Find Top 10 overseas education consultants Near you

@endsection
@section('description')
Find Only Certified Training Institutes, Coaching Centers near you on Estivaledge and Get Free counseling, Free Demo Classes, and Get Placement Assistence.
@endsection
@section('content')	
  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Coin History</h1>
    
    </div>
 <style>
        

        .table-container {
            max-width: 1000px;
            margin: 0 auto;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            overflow-x: auto;
            max-height: 400px;
            overflow-y: auto;
            position: relative;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            padding: 12px 15px;
            text-align: center;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #e6e6e6;
            font-weight: normal;
            color: #333;
            position: sticky;
            top: 0;
            z-index: 1;
        }

        td {
            font-weight: bold;
            color: #333;
        }

        /* Mouse-over Animation */
        tr {
            transition: background-color 0.3s ease;
        }

        tr:hover {
            background-color: #f0f8ff;
        }

        /* Expanded Row Details */
        .expanded-details {
            display: none;
            background-color: #f9f9f9;
            padding: 10px;
            text-align: left;
            font-weight: normal;
            font-size: 14px;
            border-top: 1px solid #ddd;
        }

        tr.expanded .expanded-details {
            display: block;
        }

        /* No More Data Message */
        .no-data-row {
            background-color: #f0f0f0;
            font-style: italic;
            color: #666;
        }

        .no-data-row td {
            font-weight: normal;
            padding: 15px;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .table-container {
                max-height: 300px;
            }

            th, td {
                padding: 8px 10px;
                font-size: 14px;
            }

            .expanded-details {
                font-size: 12px;
            }
        }

        @media (max-width: 480px) {
            .table-container {
                max-height: 250px;
            }

            table, thead, tbody, th, td, tr {
                display: block;
            }

            thead tr {
                display: none;
            }

            tr {
                margin-bottom: 10px;
                border-bottom: 2px solid #ddd;
            }

            td {
                text-align: right;
                padding-left: 50%;
                position: relative;
                font-size: 14px;
            }

            td::before {
                content: attr(data-label);
                position: absolute;
                left: 10px;
                width: 45%;
                text-align: left;
                font-weight: normal;
                color: #666;
            }

            .expanded-details {
                text-align: right;
                padding: 5px 0;
            }

            .no-data-row td {
                text-align: center;
                padding-left: 0;
            }

            .no-data-row td::before {
                content: none;
            }
        }
    </style>

 <div class="table-container" id="tableContainer">
        <table>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Mobile</th>
                    <th>Service</th>
                    <th>Coins</th>
                </tr>
            </thead>
            <tbody id="tableBody">
                <!-- Initially load first 10 data rows -->
                <tr class="data-row">
                    <td data-label="Date">08 Feb 2025</td>
                    <td data-label="Value 1">1022.00</td>
                    <td data-label="Value 2">184.00</td>
                    <td data-label="Total">1206.00</td>
                </tr>
              
                <tr class="data-row">
                    <td data-label="Date">08 Feb 2025</td>
                    <td data-label="Value 1">1022.00</td>
                    <td data-label="Value 2">184.00</td>
                    <td data-label="Total">1206.00</td>
                </tr>
            
                <tr class="data-row">
                    <td data-label="Date">08 Feb 2025</td>
                    <td data-label="Value 1">1022.00</td>
                    <td data-label="Value 2">184.00</td>
                    <td data-label="Total">1206.00</td>
                </tr>
                <tr class="expanded-details">
                    <td colspan="4">
                        Breakdown: Base: 1000.00, Tax: 206.00
                    </td>
                </tr>
                <tr class="data-row">
                    <td data-label="Date">08 Feb 2025</td>
                    <td data-label="Value 1">1022.00</td>
                    <td data-label="Value 2">184.00</td>
                    <td data-label="Total">1206.00</td>
                </tr>
                <tr class="expanded-details">
                    <td colspan="4">
                        Breakdown: Base: 1000.00, Tax: 206.00
                    </td>
                </tr>
                <tr class="data-row">
                    <td data-label="Date">08 Feb 2025</td>
                    <td data-label="Value 1">1022.00</td>
                    <td data-label="Value 2">184.00</td>
                    <td data-label="Total">1206.00</td>
                </tr>
                <tr class="expanded-details">
                    <td colspan="4">
                        Breakdown: Base: 1000.00, Tax: 206.00
                    </td>
                </tr>
                <tr class="data-row">
                    <td data-label="Date">08 Feb 2025</td>
                    <td data-label="Value 1">1022.00</td>
                    <td data-label="Value 2">184.00</td>
                    <td data-label="Total">1206.00</td>
                </tr>
                <tr class="expanded-details">
                    <td colspan="4">
                        Breakdown: Base: 1000.00, Tax: 206.00
                    </td>
                </tr>
                <tr class="data-row">
                    <td data-label="Date">08 Feb 2025</td>
                    <td data-label="Value 1">1022.00</td>
                    <td data-label="Value 2">184.00</td>
                    <td data-label="Total">1206.00</td>
                </tr>
                <tr class="expanded-details">
                    <td colspan="4">
                        Breakdown: Base: 1000.00, Tax: 206.00
                    </td>
                </tr>
                <tr class="data-row">
                    <td data-label="Date">08 Feb 2025</td>
                    <td data-label="Value 1">1022.00</td>
                    <td data-label="Value 2">184.00</td>
                    <td data-label="Total">1100.00</td>
                </tr>
              
                <tr class="data-row">
                    <td data-label="Date">08 Feb 2025</td>
                    <td data-label="Value 1">1022.00</td>
                    <td data-label="Value 2">184.00</td>
                    <td data-label="Total">1200.00</td>
                </tr>
              
                <tr class="data-row">
                    <td data-label="Date">1 Feb 2025</td>
                    <td data-label="Value 1">1022.00</td>
                    <td data-label="Value 2">184.00</td>
                    <td data-label="Total">1003.00</td>
                </tr>
              
            </tbody>
        </table>
    </div>
 <script>
        const tableContainer = document.getElementById('tableContainer');
        const tableBody = document.getElementById('tableBody');

        // Remaining data to load
        const remainingData = [
            {
                date: "02 Feb 2025",
                value1: 1022.00,
                value2: 184.00,
                total: 110.00,
                breakdown: { base: 1000.00, tax: 206.00 }
            },
            {
                date: "03 Feb 2025",
                value1: 1022.00,
                value2: 184.00,
                total: 120.00,
                breakdown: { base: 1000.00, tax: 206.00 }
            }, {
                date: "04 Feb 2025",
                value1: 1022.00,
                value2: 184.00,
                total: 130.00,
                breakdown: { base: 1000.00, tax: 206.00 }
            },
            {
                date: "05 Feb 2025",
                value1: 1022.00,
                value2: 184.00,
                total: 140.00,
                breakdown: { base: 1000.00, tax: 206.00 }
            }, {
                date: "06 Feb 2025",
                value1: 1022.00,
                value2: 184.00,
                total: 150.00,
                breakdown: { base: 1000.00, tax: 206.00 }
            },
            {
                date: "07 Feb 2025",
                value1: 1022.00,
                value2: 184.00,
                total: 160.00,
                breakdown: { base: 1000.00, tax: 206.00 }
            }, {
                date: "09 Feb 2025",
                value1: 1022.00,
                value2: 184.00,
                total: 170.00,
                breakdown: { base: 1000.00, tax: 206.00 }
            },
            {
                date: "10 Feb 2025",
                value1: 1022.00,
                value2: 184.00,
                total: 180.00,
                breakdown: { base: 1000.00, tax: 206.00 }
            }, {
                date: "08 Feb 2025",
                value1: 1022.00,
                value2: 184.00,
                total: 190.00,
                breakdown: { base: 1000.00, tax: 206.00 }
            },
            {
                date: "11 Feb 2025",
                value1: 1022.00,
                value2: 184.00,
                total: 200.00,
                breakdown: { base: 1000.00, tax: 206.00 }
            }, {
                date: "12 Feb 2025",
                value1: 1022.00,
                value2: 184.00,
                total: 210.00,
                breakdown: { base: 1000.00, tax: 206.00 }
            },
            {
                date: "13 Feb 2025",
                value1: 1022.00,
                value2: 184.00,
                total: 220.00,
                breakdown: { base: 1000.00, tax: 206.00 }
            }, {
                date: "14 Feb 2025",
                value1: 1022.00,
                value2: 184.00,
                total: 230.00,
                
            },
            {
                date: "15 Feb 2025",
                value1: 1022.00,
                value2: 184.00,
                total: 240.00,
                
            }
        ];

        // Function to append new rows
        function appendRows(dataArray) {
            dataArray.forEach(data => {
                const dataRow = document.createElement('tr');
                dataRow.classList.add('data-row');
                dataRow.innerHTML = `
                    <td data-label="Date">${data.date}</td>
                    <td data-label="Value 1">${data.value1.toFixed(2)}</td>
                    <td data-label="Value 2">${data.value2.toFixed(2)}</td>
                    <td data-label="Total">${data.total.toFixed(2)}</td>
                `;

                const detailRow = document.createElement('tr');
                detailRow.classList.add('expanded-details');
              

                tableBody.appendChild(dataRow);
                tableBody.appendChild(detailRow);
            });
        }

        // Function to append "Data is finished" message
        function appendNoDataMessage() {
            const noDataRow = document.createElement('tr');
            noDataRow.classList.add('no-data-row');
            noDataRow.innerHTML = `
                <td colspan="4">Data is finished</td>
            `;
            tableBody.appendChild(noDataRow);
        }

        // Infinite scroll to load more rows
        let isLoading = false;
        let hasShownNoDataMessage = false;
        tableContainer.addEventListener('scroll', () => {
            if (isLoading) return;

            const { scrollTop, scrollHeight, clientHeight } = tableContainer;
            if (scrollTop + clientHeight >= scrollHeight - 5) {
                if (remainingData.length > 0) {
                    isLoading = true;
                    setTimeout(() => {
                        appendRows(remainingData.splice(0, 2)); // Load 2 rows at a time
                        isLoading = false;
                    }, 500);
                } else if (!hasShownNoDataMessage) {
                    appendNoDataMessage();
                    hasShownNoDataMessage = true;
                }
            }

            // Expand rows in viewport
            const rows = document.querySelectorAll('tr.data-row');
            rows.forEach((row) => {
                const rect = row.getBoundingClientRect();
                const containerRect = tableContainer.getBoundingClientRect();

                const isInView = rect.top >= containerRect.top && rect.bottom <= containerRect.bottom;
                if (isInView) {
                    row.classList.add('expanded');
                    const detailRow = row.nextElementSibling;
                    if (detailRow && detailRow.classList.contains('expanded-details')) {
                        detailRow.style.display = 'block';
                    }
                } else {
                    row.classList.remove('expanded');
                    const detailRow = row.nextElementSibling;
                    if (detailRow && detailRow.classList.contains('expanded-details')) {
                        detailRow.style.display = 'none';
                    }
                }
            });
        });

        // Initial check to expand rows in view on page load
        const initialScrollEvent = new Event('scroll');
        tableContainer.dispatchEvent(initialScrollEvent);
    </script>
</body>
</html>

  </main>

 @endsection