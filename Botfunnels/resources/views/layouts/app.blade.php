<!DOCTYPE html>
<html class=" " xmlns="http://www.w3.org/1999/html">
<head>
<!--
         * @Package: Ultra Admin - Responsive Theme
         * @Subpackage: Bootstrap
         * @Version: 4.1
         * This file is part of Ultra Admin Theme.
        -->
    <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
    <meta charset="utf-8" />
    <title>{{ config('app.name', 'BotFunnels') }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <meta content="" name="description" />
    <meta content="" name="author" />
    <meta name="csrf-token" content="{{ csrf_token() }}">

   {{-- <link rel="shortcut icon" href="{{asset('/images/favicon.png" type="image/x-icon')}}" /> --}}   <!-- Favicon -->
    <link rel="apple-touch-icon-precomposed" href="{{asset('/images/apple-touch-icon-57-precomposed.png')}}">	<!-- For iPhone -->
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="{{asset('/images/apple-touch-icon-114-precomposed.png')}}">    <!-- For iPhone 4 Retina display -->
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="{{asset('/images/apple-touch-icon-72-precomposed.png')}}">    <!-- For iPad -->
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="{{asset('/images/apple-touch-icon-144-precomposed.png')}}">    <!-- For iPad Retina display -->

    <!-- CORE CSS FRAMEWORK - START -->
    <link href="{{asset('/plugins/pace/pace-theme-flash.css')}}" rel="stylesheet" type="text/css" media="screen"/>
    <link href="{{asset('/plugins/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('/plugins/bootstrap/css/bootstrap-theme.min.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('/fonts/font-awesome/css/font-awesome.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('/css/animate.min.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('/plugins/perfect-scrollbar/perfect-scrollbar.css')}}" rel="stylesheet" type="text/css"/>
    <!-- CORE CSS FRAMEWORK - END -->
    <!-- OTHER SCRIPTS INCLUDED ON THIS PAGE - START -->
    <link href="{{asset('/plugins/icheck/skins/minimal/minimal.css')}}" rel="stylesheet" type="text/css" media="screen"/>        <!-- OTHER SCRIPTS INCLUDED ON THIS PAGE - END -->
    <!-- OTHER SCRIPTS INCLUDED ON THIS PAGE - START -->
    <link href="{{asset('/plugins/datatables/css/jquery.dataTables.css')}}" rel="stylesheet" type="text/css" media="screen"/>
{{--
    <link href="{{asset('/plugins/datatables/extensions/TableTools/css/dataTables.tableTools.min.css')}}" rel="stylesheet" type="text/css" media="screen"/>
--}}
    <link href="{{asset('/plugins/datatables/extensions/Responsive/css/dataTables.responsive.css')}}" rel="stylesheet" type="text/css" media="screen"/>
    <link href="{{asset('/plugins/datatables/extensions/Responsive/bootstrap/3/dataTables.bootstrap.css')}}" rel="stylesheet" type="text/css" media="screen"/>        <!-- OTHER SCRIPTS INCLUDED ON THIS PAGE - END -->

    <!-- OTHER SCRIPTS INCLUDED ON THIS PAGE - START -->
    <link href="{{asset('/plugins/morris-chart/css/morris.css')}}" rel="stylesheet" type="text/css" media="screen"/>
    <link href="{{asset('/plugins/jquery-ui/smoothness/jquery-ui.min.css')}}" rel="stylesheet" type="text/css" media="screen"/>
    <link href="{{asset('/plugins/rickshaw-chart/css/graph.css')}}" rel="stylesheet" type="text/css" media="screen"/>
    <link href="{{asset('/plugins/rickshaw-chart/css/detail.css')}}" rel="stylesheet" type="text/css" media="screen"/>
    <link href="{{asset('/plugins/rickshaw-chart/css/legend.css')}}" rel="stylesheet" type="text/css" media="screen"/>
    <link href="{{asset('/plugins/rickshaw-chart/css/extensions.css')}}" rel="stylesheet" type="text/css" media="screen"/>
    <link href="{{asset('/plugins/rickshaw-chart/css/rickshaw.min.css')}}" rel="stylesheet" type="text/css" media="screen"/>
    <link href="{{asset('/plugins/rickshaw-chart/css/lines.css')}}" rel="stylesheet" type="text/css" media="screen"/>
    <link href="{{asset('/plugins/jvectormap/jquery-jvectormap-2.0.1.css')}}" rel="stylesheet" type="text/css" media="screen"/>
    <link href="{{asset('/plugins/icheck/skins/minimal/white.css')}}" rel="stylesheet" type="text/css" media="screen"/>        <!-- OTHER SCRIPTS INCLUDED ON THIS PAGE - END -->

    <!-- OTHER SCRIPTS INCLUDED ON THIS PAGE - START -->
    <link href="{{asset('/plugins/jquery-ui/smoothness/jquery-ui.min.css')}}" rel="stylesheet" type="text/css" media="screen"/>
    <link href="{{asset('/plugins/datepicker/css/datepicker.css')}}" rel="stylesheet" type="text/css" media="screen"/>
    <link href="{{asset('/plugins/daterangepicker/css/daterangepicker-bs3.css')}}" rel="stylesheet" type="text/css" media="screen"/>
    <link href="{{asset('/plugins/timepicker/css/bootstrap-timepicker.css')}}" rel="stylesheet" type="text/css" media="screen"/>
    <link href="{{asset('/plugins/datetimepicker/css/bootstrap-datetimepicker.min.css')}}" rel="stylesheet" type="text/css" media="screen"/>
    <link href="{{asset('/plugins/colorpicker/css/bootstrap-colorpicker.min.css')}}" rel="stylesheet" type="text/css" media="screen"/>
    <link href="{{asset('/plugins/ios-switch/css/switch.css')}}" rel="stylesheet" type="text/css" media="screen"/>
    <link href="{{asset('/plugins/tagsinput/css/bootstrap-tagsinput.css')}}" rel="stylesheet" type="text/css" media="screen"/>
    <link href="{{asset('/plugins/select2/select2.css')}}" rel="stylesheet" type="text/css" media="screen"/>
    <link href="{{asset('/plugins/typeahead/css/typeahead.css')}}" rel="stylesheet" type="text/css" media="screen"/>
    <link href="{{asset('/plugins/multi-select/css/multi-select.css')}}" rel="stylesheet" type="text/css" media="screen"/>
    <!-- OTHER SCRIPTS INCLUDED ON THIS PAGE - END -->
    <!-- CORE CSS TEMPLATE - START -->
    <link href="{{asset('/css/style.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('/css/responsive.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('/css/dashboard.css')}}" rel="stylesheet" type="text/css"/>
    <!-- CORE CSS TEMPLATE - END -->

    <link href="{{asset('/plugins/calendar/fullcalendar.css')}}" rel="stylesheet" type="text/css" media="screen"/>
    <link href="{{asset('/plugins/icheck/skins/minimal/minimal.css')}}" rel="stylesheet" type="text/css" media="screen"/>

    <script>
        window.Laravel = <?php echo json_encode([
                'csrfToken' => csrf_token(),
        ]); ?>
    </script>

    <!-- broadcast page -->

      <!-- CORE JS FRAMEWORK - START -->
    <script src="{{asset('/js/jquery-1.11.2.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('/js/jquery.easing.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('/plugins/bootstrap/js/bootstrap.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('/plugins/pace/pace.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('/plugins/perfect-scrollbar/perfect-scrollbar.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('/plugins/viewport/viewportchecker.js')}}" type="text/javascript"></script>


    <script src="{{asset('/plugins/calendar/moment.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('/plugins/jquery-ui/smoothness/jquery-ui.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('/plugins/calendar/fullcalendar.js')}}" type="text/javascript"></script>
    <script src="{{asset('/plugins/icheck/icheck.min.js')}}" type="text/javascript"></script>
    <!-- OTHER SCRIPTS INCLUDED ON THIS PAGE - END -->


    <!-- CORE TEMPLATE JS - START -->
    <script src="{{asset('/js/scripts.js')}}" type="text/javascript"></script>
    <!-- END CORE TEMPLATE JS - END -->


    <!-- CORE JS FRAMEWORK - END -->

    <!-- OTHER SCRIPTS INCLUDED ON THIS PAGE - START -->
    <script src="{{asset('/plugins/datatables/js/jquery.dataTables.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('/plugins/datatables/extensions/TableTools/js/dataTables.tableTools.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('/plugins/datatables/extensions/Responsive/js/dataTables.responsive.min.js')}}" type="text/javascript"></script>
{{--
    <script src="{{asset('/plugins/datatables/xtensions/Responsive/bootstrap/3/dataTables.bootstrap.js')}}" type="text/javascript"></script><!-- OTHER SCRIPTS INCLUDED ON THIS PAGE - END -->
--}}

    <!-- OTHER SCRIPTS INCLUDED ON THIS PAGE - START -->
    <script src="{{asset('/plugins/flot-chart/jquery.flot.js')}}" type="text/javascript"></script>
    <script src="{{asset('/plugins/flot-chart/jquery.flot.fillbetween.js')}}" type="text/javascript"></script>
    <script src="{{asset('/plugins/flot-chart/jquery.flot.navigate.js')}}" type="text/javascript"></script>
    <script src="{{asset('/plugins/flot-chart/jquery.flot.pie.js')}}" type="text/javascript"></script>
    <script src="{{asset('/plugins/flot-chart/jquery.flot.stack.js')}}" type="text/javascript"></script>
    <script src="{{asset('/plugins/flot-chart/jquery.flot.crosshair.js')}}" type="text/javascript"></script>
    <script src="{{asset('/plugins/flot-chart/jquery.flot.time.js')}}" type="text/javascript"></script>
    <script src="{{asset('/plugins/flot-chart/jquery.flot.selection.js')}}" type="text/javascript"></script>
    <script src="{{asset('/js/chart-flot.js')}}" type="text/javascript"></script>
    <script src="{{asset('/plugins/icheck/icheck.min.js')}}" type="text/javascript">

    </script><!-- OTHER SCRIPTS INCLUDED ON THIS PAGE - END -->

    <!-- OTHER SCRIPTS INCLUDED ON THIS PAGE - START -->
    <script src="{{asset('/plugins/jquery-ui/smoothness/jquery-ui.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('/plugins/datepicker/js/datepicker.js')}}" type="text/javascript"></script>
    <script src="{{asset('/plugins/daterangepicker/js/moment.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('/plugins/daterangepicker/js/daterangepicker.js')}}" type="text/javascript"></script>
    <script src="{{asset('/plugins/timepicker/js/bootstrap-timepicker.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('/plugins/datetimepicker/js/bootstrap-datetimepicker.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('/plugins/datetimepicker/js/locales/bootstrap-datetimepicker.fr.js')}}" type="text/javascript"></script>
    <script src="{{asset('/plugins/colorpicker/js/bootstrap-colorpicker.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('/plugins/tagsinput/js/bootstrap-tagsinput.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('/plugins/select2/select2.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('/plugins/typeahead/typeahead.bundle.js')}}" type="text/javascript"></script>
    <script src="{{asset('/plugins/typeahead/handlebars.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('/plugins/multi-select/js/jquery.multi-select.js')}}" type="text/javascript"></script>
    <script src="{{asset('/plugins/multi-select/js/jquery.quicksearch.js')}}" type="text/javascript"></script> <!-- OTHER SCRIPTS INCLUDED ON THIS PAGE - END -->


    <!-- CORE TEMPLATE JS - START -->
    <script src="{{asset('/js/scripts.js')}}" type="text/javascript"></script>
    <!-- END CORE TEMPLATE JS - END -->

    <!-- Sidebar Graph - START -->
    <script src="{{asset('/plugins/sparkline-chart/jquery.sparkline.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('/js/chart-sparkline.js')}}" type="text/javascript"></script>
    <!-- Sidebar Graph - END -->


</head>
<!-- END HEAD -->
<body>
 @yield('content')
 @include('layouts.footer-scripts')
<div id="toastjs"></div>
</body>

