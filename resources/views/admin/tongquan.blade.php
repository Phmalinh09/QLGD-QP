@extends('admin/layout')
@section('page_title','Tổng quan')
@section('tongquan_select','active')
@section('container')
<div class="page-header">
    <div class="row align-items-center">
        <div class="col">
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="tongquan">Trang chủ</a></li>
                <li class="breadcrumb-item active">Tổng quan</li>
            </ul>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-xl-3 col-sm-6 col-12 d-flex">
        <div class="card bg-comman w-100">
            <div class="card-body">
                <div class="db-widgets d-flex justify-content-between align-items-center">
                    <div class="db-info">
                        <h6>Tổng sinh viên</h6>
                        <h3>{{$sinhvien}}</h3>
                    </div>
                    <div class="db-icon">
                        <img src="../assets/img/icons/dash-icon-01.svg" alt="Dashboard Icon">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-sm-6 col-12 d-flex">
        <div class="card bg-comman w-100">
            <div class="card-body">
                <div class="db-widgets d-flex justify-content-between align-items-center">
                    <div class="db-info">
                        <h6>Tổng số lớp</h6>
                        <h3>{{$lop}}</h3>
                    </div>
                    <div class="db-icon">
                        <img src="../assets/img/icons/teacher-icon-01.svg" alt="Dashboard Icon">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-sm-6 col-12 d-flex">
        <div class="card bg-comman w-100">
            <div class="card-body">
                <div class="db-widgets d-flex justify-content-between align-items-center">
                    <div class="db-info">
                        <h6>Tổng đợt học</h6>
                        <h3>{{$dothoc}}</h3>
                    </div>
                    <div class="db-icon">
                        <img src="../assets/img/icons/teacher-icon-03.svg" alt="Dashboard Icon">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-sm-6 col-12 d-flex">
        <div class="card bg-comman w-100">
            <div class="card-body">
                <div class="db-widgets d-flex justify-content-between align-items-center">
                    <div class="db-info">
                        <h6>Tổng số đợt học đã phân</h6>
                        <h3>{{$phandot}}</h3>
                    </div>
                    <div class="db-icon">
                        <img src="../assets/img/icons/student-icon-01.svg" alt="Dashboard Icon">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12 col-lg-6">

        <div class="card card-chart">
            <div class="card-header">
                <div class="row align-items-center">
                    <div class="col-6">
                        <h5 class="card-title">Tổng quan</h5>
                    </div>
                    <div class="col-6">
                        <ul class="chart-list-out">
                            <li><span class="circle-blue"></span>Tổng sinh viên</li>
                            <li><span class="circle-green"></span>Tổng số lớp</li>
                            <li class="star-menus"><a href="javascript:;"><i class="fas fa-ellipsis-v"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div style="min-height: 365px;">
                    <div id="apexchartseg0ixzc6" class="apexcharts-canvas apexchartseg0ixzc6 apexcharts-theme-light" style="width: 572px; height: 350px;"><svg id="SvgjsSvg1006" width="572" height="350" xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.com/svgjs" class="apexcharts-svg apexcharts-zoomable" xmlns:data="ApexChartsNS" transform="translate(0, 0)" style="background: transparent;">
                            <g id="SvgjsG1008" class="apexcharts-inner apexcharts-graphical" transform="translate(39.51767635345459, 30)">
                                <g id="SvgjsG1359" class="apexcharts-xaxis" transform="translate(0, 0)">
                                    <g id="SvgjsG1360" class="apexcharts-xaxis-texts-g" transform="translate(0, -4)"><text id="SvgjsText1362" font-family="Helvetica, Arial, sans-serif" x="0" y="293.99519938278195" text-anchor="middle" dominant-baseline="auto" font-size="12px" font-weight="400" fill="#373d3f" class="apexcharts-text apexcharts-xaxis-label " style="font-family: Helvetica, Arial, sans-serif;">
                                            <tspan id="SvgjsTspan1363">Đợt 1</tspan>
                                            <title>Đợt 1</title>
                                        </text><text id="SvgjsText1365" font-family="Helvetica, Arial, sans-serif" x="87.08038727442423" y="293.99519938278195" text-anchor="middle" dominant-baseline="auto" font-size="12px" font-weight="400" fill="#373d3f" class="apexcharts-text apexcharts-xaxis-label " style="font-family: Helvetica, Arial, sans-serif;">
                                            <tspan id="SvgjsTspan1366">Đợt 2</tspan>
                                            <title>Đợt 2</title>
                                        </text><text id="SvgjsText1368" font-family="Helvetica, Arial, sans-serif" x="174.16077454884848" y="293.99519938278195" text-anchor="middle" dominant-baseline="auto" font-size="12px" font-weight="400" fill="#373d3f" class="apexcharts-text apexcharts-xaxis-label " style="font-family: Helvetica, Arial, sans-serif;">
                                            <tspan id="SvgjsTspan1369">Đợt 3</tspan>
                                            <title>Đợt 3</title>
                                        </text><text id="SvgjsText1371" font-family="Helvetica, Arial, sans-serif" x="261.24116182327276" y="293.99519938278195" text-anchor="middle" dominant-baseline="auto" font-size="12px" font-weight="400" fill="#373d3f" class="apexcharts-text apexcharts-xaxis-label " style="font-family: Helvetica, Arial, sans-serif;">
                                            <tspan id="SvgjsTspan1372">Đợt 4</tspan>
                                            <title>Đợt 4</title>
                                        </text><text id="SvgjsText1374" font-family="Helvetica, Arial, sans-serif" x="348.321549097697" y="293.99519938278195" text-anchor="middle" dominant-baseline="auto" font-size="12px" font-weight="400" fill="#373d3f" class="apexcharts-text apexcharts-xaxis-label " style="font-family: Helvetica, Arial, sans-serif;">
                                            <tspan id="SvgjsTspan1375">Đợt 5</tspan>
                                            <title>Đợt 5</title>
                                        </text><text id="SvgjsText1377" font-family="Helvetica, Arial, sans-serif" x="435.40193637212127" y="293.99519938278195" text-anchor="middle" dominant-baseline="auto" font-size="12px" font-weight="400" fill="#373d3f" class="apexcharts-text apexcharts-xaxis-label " style="font-family: Helvetica, Arial, sans-serif;">
                                            <tspan id="SvgjsTspan1378">Đợt 6</tspan>
                                            <title>Đợt 6</title>
                                        </text><text id="SvgjsText1380" font-family="Helvetica, Arial, sans-serif" x="522.4823236465454" y="293.99519938278195" text-anchor="middle" dominant-baseline="auto" font-size="12px" font-weight="400" fill="#373d3f" class="apexcharts-text apexcharts-xaxis-label " style="font-family: Helvetica, Arial, sans-serif;">
                                            <tspan id="SvgjsTspan1381">Đợt 7</tspan>
                                            <title>Đợt 7</title>
                                        </text></g>
                                    <line id="SvgjsLine1382" x1="0" y1="265.99519938278195" x2="522.4823236465454" y2="265.99519938278195" stroke="#e0e0e0" stroke-dasharray="0" stroke-width="1"></line>
                                </g>
                                <g id="SvgjsG1065" class="apexcharts-grid">
                                    <g id="SvgjsG1066" class="apexcharts-gridlines-horizontal">
                                        <line id="SvgjsLine1075" x1="0" y1="0" x2="522.4823236465454" y2="0" stroke="#e0e0e0" stroke-dasharray="0" class="apexcharts-gridline"></line>
                                        <line id="SvgjsLine1076" x1="0" y1="44.16586656379699" x2="522.4823236465454" y2="44.16586656379699" stroke="#e0e0e0" stroke-dasharray="0" class="apexcharts-gridline"></line>
                                        <line id="SvgjsLine1077" x1="0" y1="88.33173312759398" x2="522.4823236465454" y2="88.33173312759398" stroke="#e0e0e0" stroke-dasharray="0" class="apexcharts-gridline"></line>
                                        <line id="SvgjsLine1078" x1="0" y1="132.49759969139097" x2="522.4823236465454" y2="132.49759969139097" stroke="#e0e0e0" stroke-dasharray="0" class="apexcharts-gridline"></line>
                                        <line id="SvgjsLine1079" x1="0" y1="176.66346625518796" x2="522.4823236465454" y2="176.66346625518796" stroke="#e0e0e0" stroke-dasharray="0" class="apexcharts-gridline"></line>
                                        <line id="SvgjsLine1080" x1="0" y1="220.82933281898494" x2="522.4823236465454" y2="220.82933281898494" stroke="#e0e0e0" stroke-dasharray="0" class="apexcharts-gridline"></line>
                                        <line id="SvgjsLine1081" x1="0" y1="264.99519938278195" x2="522.4823236465454" y2="264.99519938278195" stroke="#e0e0e0" stroke-dasharray="0" class="apexcharts-gridline"></line>
                                    </g>
                                    <g id="SvgjsG1067" class="apexcharts-gridlines-vertical"></g>
                                    <line id="SvgjsLine1068" x1="0" y1="265.99519938278195" x2="0" y2="271.99519938278195" stroke="#e0e0e0" stroke-dasharray="0" class="apexcharts-xaxis-tick"></line>
                                    <line id="SvgjsLine1069" x1="87.08038727442424" y1="265.99519938278195" x2="87.08038727442424" y2="271.99519938278195" stroke="#e0e0e0" stroke-dasharray="0" class="apexcharts-xaxis-tick"></line>
                                    <line id="SvgjsLine1070" x1="174.16077454884848" y1="265.99519938278195" x2="174.16077454884848" y2="271.99519938278195" stroke="#e0e0e0" stroke-dasharray="0" class="apexcharts-xaxis-tick"></line>
                                    <line id="SvgjsLine1071" x1="261.2411618232727" y1="265.99519938278195" x2="261.2411618232727" y2="271.99519938278195" stroke="#e0e0e0" stroke-dasharray="0" class="apexcharts-xaxis-tick"></line>
                                    <line id="SvgjsLine1072" x1="348.32154909769696" y1="265.99519938278195" x2="348.32154909769696" y2="271.99519938278195" stroke="#e0e0e0" stroke-dasharray="0" class="apexcharts-xaxis-tick"></line>
                                    <line id="SvgjsLine1073" x1="435.4019363721212" y1="265.99519938278195" x2="435.4019363721212" y2="271.99519938278195" stroke="#e0e0e0" stroke-dasharray="0" class="apexcharts-xaxis-tick"></line>
                                    <line id="SvgjsLine1074" x1="522.4823236465454" y1="265.99519938278195" x2="522.4823236465454" y2="271.99519938278195" stroke="#e0e0e0" stroke-dasharray="0" class="apexcharts-xaxis-tick"></line>
                                    <line id="SvgjsLine1083" x1="0" y1="264.99519938278195" x2="522.4823236465454" y2="264.99519938278195" stroke="transparent" stroke-dasharray="0"></line>
                                    <line id="SvgjsLine1082" x1="0" y1="1" x2="0" y2="264.99519938278195" stroke="transparent" stroke-dasharray="0"></line>
                                </g>
                            </g>
                            <rect id="SvgjsRect1012" width="0" height="0" x="0" y="0" rx="0" ry="0" opacity="1" stroke-width="0" stroke="none" stroke-dasharray="0" fill="#fefefe"></rect>
                            <g id="SvgjsG1049" class="apexcharts-yaxis" rel="0" transform="translate(9.51767635345459, 0)">
                                <g id="SvgjsG1050" class="apexcharts-yaxis-texts-g"><text id="SvgjsText1051" font-family="Helvetica, Arial, sans-serif" x="20" y="31.6" text-anchor="end" dominant-baseline="auto" font-size="11px" font-weight="400" fill="#373d3f" class="apexcharts-text apexcharts-yaxis-label " style="font-family: Helvetica, Arial, sans-serif;">
                                        <tspan id="SvgjsTspan1052">600</tspan>
                                    </text><text id="SvgjsText1053" font-family="Helvetica, Arial, sans-serif" x="20" y="75.76586656379698" text-anchor="end" dominant-baseline="auto" font-size="11px" font-weight="400" fill="#373d3f" class="apexcharts-text apexcharts-yaxis-label " style="font-family: Helvetica, Arial, sans-serif;">
                                        <tspan id="SvgjsTspan1054">500</tspan>
                                    </text><text id="SvgjsText1055" font-family="Helvetica, Arial, sans-serif" x="20" y="119.93173312759396" text-anchor="end" dominant-baseline="auto" font-size="11px" font-weight="400" fill="#373d3f" class="apexcharts-text apexcharts-yaxis-label " style="font-family: Helvetica, Arial, sans-serif;">
                                        <tspan id="SvgjsTspan1056">400</tspan>
                                    </text><text id="SvgjsText1057" font-family="Helvetica, Arial, sans-serif" x="20" y="164.09759969139094" text-anchor="end" dominant-baseline="auto" font-size="11px" font-weight="400" fill="#373d3f" class="apexcharts-text apexcharts-yaxis-label " style="font-family: Helvetica, Arial, sans-serif;">
                                        <tspan id="SvgjsTspan1058">300</tspan>
                                    </text><text id="SvgjsText1059" font-family="Helvetica, Arial, sans-serif" x="20" y="208.26346625518792" text-anchor="end" dominant-baseline="auto" font-size="11px" font-weight="400" fill="#373d3f" class="apexcharts-text apexcharts-yaxis-label " style="font-family: Helvetica, Arial, sans-serif;">
                                        <tspan id="SvgjsTspan1060">200</tspan>
                                    </text><text id="SvgjsText1061" font-family="Helvetica, Arial, sans-serif" x="20" y="252.4293328189849" text-anchor="end" dominant-baseline="auto" font-size="11px" font-weight="400" fill="#373d3f" class="apexcharts-text apexcharts-yaxis-label " style="font-family: Helvetica, Arial, sans-serif;">
                                        <tspan id="SvgjsTspan1062">100</tspan>
                                    </text><text id="SvgjsText1063" font-family="Helvetica, Arial, sans-serif" x="20" y="296.5951993827819" text-anchor="end" dominant-baseline="auto" font-size="11px" font-weight="400" fill="#373d3f" class="apexcharts-text apexcharts-yaxis-label " style="font-family: Helvetica, Arial, sans-serif;">
                                        <tspan id="SvgjsTspan1064">0</tspan>
                                    </text>
                                </g>
                            </g>
                        </svg>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <div class="col-md-12 col-lg-6">

        <div class="card card-chart">
            <div class="card-header">
                <div class="row align-items-center">
                    <div class="col-6">
                        <h5 class="card-title">Sinh viên</h5>
                    </div>
                    <div class="col-6">
                        <ul class="chart-list-out">
                            <li><span class="circle-blue"></span>Nữ </li>
                            <li><span class="circle-green"></span>Nam</li>
                            <li class="star-menus"><a href="javascript:;"><i class="fas fa-ellipsis-v"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div style="min-height: 365px;">
                    <div id="apexcharts0j5dmjwu" class="apexcharts-canvas apexcharts0j5dmjwu apexcharts-theme-light" style="width: 572px; height: 350px;"><svg id="SvgjsSvg1094" width="572" height="350" xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.com/svgjs" class="apexcharts-svg" xmlns:data="ApexChartsNS" transform="translate(0, 0)" style="background: transparent;">
                            <g id="SvgjsG1096" class="apexcharts-inner apexcharts-graphical" transform="translate(45.63535118103027, 35)">


                                <g id="SvgjsG1151" class="apexcharts-grid">
                                    <g id="SvgjsG1152" class="apexcharts-gridlines-horizontal">
                                        <line id="SvgjsLine1154" x1="0" y1="0" x2="516.3646488189697" y2="0" stroke="#e0e0e0" stroke-dasharray="0" class="apexcharts-gridline"></line>
                                        <line id="SvgjsLine1155" x1="0" y1="70.5" x2="516.3646488189697" y2="70.5" stroke="#e0e0e0" stroke-dasharray="0" class="apexcharts-gridline"></line>
                                        <line id="SvgjsLine1156" x1="0" y1="141" x2="516.3646488189697" y2="141" stroke="#e0e0e0" stroke-dasharray="0" class="apexcharts-gridline"></line>
                                        <line id="SvgjsLine1157" x1="0" y1="211.5" x2="516.3646488189697" y2="211.5" stroke="#e0e0e0" stroke-dasharray="0" class="apexcharts-gridline"></line>
                                        <line id="SvgjsLine1158" x1="0" y1="282" x2="516.3646488189697" y2="282" stroke="#e0e0e0" stroke-dasharray="0" class="apexcharts-gridline"></line>
                                    </g>
                                    <g id="SvgjsG1153" class="apexcharts-gridlines-vertical"></g>
                                    <line id="SvgjsLine1160" x1="0" y1="282" x2="516.3646488189697" y2="282" stroke="transparent" stroke-dasharray="0"></line>
                                    <line id="SvgjsLine1159" x1="0" y1="1" x2="0" y2="282" stroke="transparent" stroke-dasharray="0"></line>
                                </g>

                            </g><text id="SvgjsText1098" font-family="Helvetica, Arial, sans-serif" x="10" y="20.5" text-anchor="start" dominant-baseline="auto" font-size="18px" font-weight="900" fill="#373d3f" class="apexcharts-title-text" style="font-family: Helvetica, Arial, sans-serif; opacity: 1;"></text>
                            <g id="SvgjsG1139" class="apexcharts-yaxis" rel="0" transform="translate(15.635351181030273, 0)">
                                <g id="SvgjsG1140" class="apexcharts-yaxis-texts-g"><text id="SvgjsText1141" font-family="Helvetica, Arial, sans-serif" x="20" y="36.4" text-anchor="end" dominant-baseline="auto" font-size="11px" font-weight="400" fill="#777777" class="apexcharts-text apexcharts-yaxis-label " style="font-family: Helvetica, Arial, sans-serif;">
                                        <tspan id="SvgjsTspan1142">800</tspan>
                                    </text><text id="SvgjsText1143" font-family="Helvetica, Arial, sans-serif" x="20" y="106.9" text-anchor="end" dominant-baseline="auto" font-size="11px" font-weight="400" fill="#777777" class="apexcharts-text apexcharts-yaxis-label " style="font-family: Helvetica, Arial, sans-serif;">
                                        <tspan id="SvgjsTspan1144">600</tspan>
                                    </text><text id="SvgjsText1145" font-family="Helvetica, Arial, sans-serif" x="20" y="177.4" text-anchor="end" dominant-baseline="auto" font-size="11px" font-weight="400" fill="#777777" class="apexcharts-text apexcharts-yaxis-label " style="font-family: Helvetica, Arial, sans-serif;">
                                        <tspan id="SvgjsTspan1146">400</tspan>
                                    </text><text id="SvgjsText1147" font-family="Helvetica, Arial, sans-serif" x="20" y="247.9" text-anchor="end" dominant-baseline="auto" font-size="11px" font-weight="400" fill="#777777" class="apexcharts-text apexcharts-yaxis-label " style="font-family: Helvetica, Arial, sans-serif;">
                                        <tspan id="SvgjsTspan1148">200</tspan>
                                    </text><text id="SvgjsText1149" font-family="Helvetica, Arial, sans-serif" x="20" y="318.4" text-anchor="end" dominant-baseline="auto" font-size="11px" font-weight="400" fill="#777777" class="apexcharts-text apexcharts-yaxis-label " style="font-family: Helvetica, Arial, sans-serif;">
                                        <tspan id="SvgjsTspan1150">0</tspan>
                                    </text></g>
                            </g>
                            <g id="SvgjsG1097" class="apexcharts-annotations"></g>
                        </svg>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection