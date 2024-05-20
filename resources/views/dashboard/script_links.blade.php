
<script src="{{asset('dashboard_assets/assets/js/core/jquery_3_6.js')}}"></script>
<script src="{{asset('dashboard_assets/assets/js/core/popper.min.js')}}"></script>
<script src="{{asset('dashboard_assets/assets/js/core/bootstrap.min.js')}}"></script>
<script src="{{asset('dashboard_assets/assets/js/plugins/smooth-scrollbar.min.js')}}"></script>
<script src="{{asset('dashboard_assets/assets/js/plugins/chartjs.min.js')}}"></script>
<!-- <script src="{{asset('dashboard_assets/assets/js/plugins/pdf.js')}}"></script> -->
<!-- <script src="{{asset('dashboard_assets/assets/js/plugins/pdf_viewer.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/pdfjs-dist@3.3.122/build/pdf.min.js"></script> -->
<script async defer src="https://buttons.github.io/buttons.js"></script>

<!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
<script src="{{asset('dashboard_assets/assets/js/plugins/select.js')}}"></script>
<!-- fontawesome kit  -->
<script src="https://kit.fontawesome.com/46ede82261.js" crossorigin="anonymous"></script>



<script src="{{asset('dashboard_assets/assets/js/plugins/datatables.js')}}"></script>
<script src="https://cdn.datatables.net/buttons/2.3.4/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.3.4/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.3.4/js/buttons.print.min.js"></script>

<script>
        function defaultSelect2(selectDropDown) { // pass selected element
            $(selectDropDown).val("").change();
            $(selectDropDown).prop('disabled', false)
            $(selectDropDown).find('option').each((key, value) => {
                $(value).prop('selected', false)
            })

        }


</script>








<script src="{{asset('dashboard_assets/assets/js/plugins/validate.js')}}"></script>
<canvas id="chart-line" style="display: none;"> </canvas>

<script>
            var ctx1 = document.getElementById("chart-line").getContext("2d");
            var gradientStroke1 = ctx1.createLinearGradient(0, 230, 0, 50);
            gradientStroke1.addColorStop(1, 'rgba(94, 114, 228, 0.2)');
            gradientStroke1.addColorStop(0.2, 'rgba(94, 114, 228, 0.0)');
            gradientStroke1.addColorStop(0, 'rgba(94, 114, 228, 0)');
            new Chart(ctx1, {
                type: "line",
                data: {
                    labels: ["Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
                    datasets: [{
                        label: "Mobile apps",
                        tension: 0.4,
                        borderWidth: 0,
                        pointRadius: 0,
                        borderColor: "#5e72e4",
                        backgroundColor: gradientStroke1,
                        borderWidth: 3,
                        fill: true,
                        data: [50, 40, 300, 220, 500, 250, 400, 230, 500],
                        maxBarThickness: 6

                    }],
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false,
                        }
                    },
                    interaction: {
                        intersect: false,
                        mode: 'index',
                    },
                    scales: {
                        y: {
                            grid: {
                                drawBorder: false,
                                display: true,
                                drawOnChartArea: true,
                                drawTicks: false,
                                borderDash: [5, 5]
                            },
                            ticks: {
                                display: true,
                                padding: 10,
                                color: '#fbfbfb',
                                font: {
                                    size: 11,
                                    family: "Open Sans",
                                    style: 'normal',
                                    lineHeight: 2
                                },
                            }
                        },
                        x: {
                            grid: {
                                drawBorder: false,
                                display: false,
                                drawOnChartArea: false,
                                drawTicks: false,
                                borderDash: [5, 5]
                            },
                            ticks: {
                                display: true,
                                color: '#ccc',
                                padding: 20,
                                font: {
                                    size: 11,
                                    family: "Open Sans",
                                    style: 'normal',
                                    lineHeight: 2
                                },
                            }
                        },
                    },
                },
            });
            var win = navigator.platform.indexOf('Win') > -1;
            if (win && document.querySelector('#sidenav-scrollbar')) {
                var options = {
                    damping: '0.5'
                }
                Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
            }
        </script>


<script src="{{asset('dashboard_assets/assets/tinymce/tinymce.min.js')}}"></script>
<script src="{{asset('dashboard_assets/assets/js/argon-dashboard.js')}}"></script>



<script src="{{asset('dashboard_assets/assets/js/perfect_scrollbar.min.js')}}"></script>
<script src="{{asset('dashboard_assets/assets/js/custom.js')}}"></script>
<script src="{{asset('dashboard_assets/assets/js/switch_button.js')}}"></script>

<!-- Github buttons -->
