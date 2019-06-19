@extends('layouts.master')
@section('content')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js"></script>
    <div class="form-group">
        <div class="row">
            <div class="col">
                <label>Количество созданных заявок</label>
                <canvas id="myChart" width="400" height="400"></canvas>
            </div>
            <div class="col">
                <canvas id="mylineChart"></canvas>
            </div>
        </div>
    </div>

    <script>
        let users=@json($users);
        let usersCount=@json($usersCount);
        console.log(usersCount);
        let usersD=[];
        let usersC=[];
        for(i=0;i<users.length;++i){
            //console.log(myChart.data.labels);
            usersD.push(users[i].name);
            usersC.push(usersCount[i]);
        }
        let ctx = document.getElementById('myChart');
        let myChart = new Chart(ctx, {
            type: 'bar',
            data: {

                labels: usersD,
                datasets: [{
                    label: '# of Votes',
                    data: usersC,
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }
        });
        let applications=@json($applications);
        console.log(applications);
        let line=document.getElementById('mylineChart');
        let myLineChart = new Chart(line, {
            type: 'line',
            data: {

                labels: ['01','02','03','04','05','06','07','08','09','10','11','12','13','14','15','16','17','18','19','20','21','22','23','24','25','26','27','28','29','30','31'],
                datasets: [{
                    label: '# of Votes',
                    data: usersC,
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }
        });
    </script>
    @endsection