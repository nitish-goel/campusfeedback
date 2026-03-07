<?php include './layout/header.php'; ?>
<?php include './layout/sidebar.php'; ?>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<h2 class="mb-4">Admin Dashboard</h2>


    <div class="row mb-4">

        <div class="col-md-3">
            <div class="card text-center shadow-sm">
                <div class="card-body">
                    <h5>Total Forms</h5>
                    <h3 id="totalForms">0</h3>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card text-center shadow-sm">
                <div class="card-body">
                    <h5>Active Form</h5>
                    <h5 id="activeForm">None</h5>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card text-center shadow-sm">
                <div class="card-body">
                    <h5>Total Submissions</h5>
                    <h3 id="totalSubmissions">0</h3>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card text-center shadow-sm">
                <div class="card-body">
                    <h5>Unique Students</h5>
                    <h3 id="totalStudents">0</h3>
                </div>
            </div>
        </div>

    </div>
    <div class="card shadow-sm">

        <div class="card-header">
             <h5 class="mb-0">Latest Submissions</h5>
        </div>

        <div class="card-body">

            <table class="table table-bordered">

            <thead>
            <tr>
            <th>Roll Number</th>
            <th>Form</th>
            <th>Submitted At</th>
            </tr>
            </thead>

            <tbody id="latestSubmissions"></tbody>

            </table>

        </div>
    </div>
    <div class="card shadow-sm mt-4">

        <div class="card-header">
            <h5 class="mb-0">Submissions Analytics</h5>
        </div>

        <div class="card-body">

            <canvas id="submissionChart"></canvas>

        </div>
    </div>
<script>
    fetch("../../api/get_dashboard_stats.php",{
        credentials:"include"
        })
        .then(res=>res.json())
        .then(data=>{

        if(!data.status) return;

        document.getElementById("totalForms").innerText =
        data.data.forms;

        document.getElementById("activeForm").innerText =
        data.data.active_form;

        document.getElementById("totalSubmissions").innerText =
        data.data.submissions;

        document.getElementById("totalStudents").innerText =
        data.data.students;

        });
</script>
<script>
    fetch("../../api/get_latest_submissions.php",{
        credentials:"include"
        })
        .then(res=>res.json())
        .then(data=>{

        let table = document.getElementById("latestSubmissions");

        data.data.forEach(row=>{

                table.innerHTML += `
                <tr>
                <td>${row.roll_number}</td>
                <td>${row.title}</td>
                <td>${row.submitted_at}</td>
                </tr>
                `;

                });

    });
</script>
<script>
    fetch("../../api/get_submission_chart.php",{
    credentials:"include"
        })
        .then(res=>res.json())
        .then(data=>{

                let labels = [];
                let values = [];

            data.data.forEach(row=>{
                labels.push(row.date);
                values.push(row.total);
            });

            const ctx = document.getElementById('submissionChart');

            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Submissions',
                        data: values,
                        backgroundColor: '#0d6efd'
                        }]
                },
                options: {
                    responsive: true,
                    plugins:{
                        legend:{display:false}
                        }
                }
            });

        });
</script>
<?php include './layout/footer.php'; ?>