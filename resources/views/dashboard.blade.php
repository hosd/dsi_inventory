@section('title', 'Dashboard')

<x-app-layout>
    <x-slot name="header">

    </x-slot>

    <div id="main" role="main">
        <!-- RIBBON -->
        <div id="ribbon">
        </div>
        <!-- END RIBBON -->
        	<div id="content">

				<!-- row -->
				<div class="row">
					
					<!-- col -->
					<div class="col-xs-11 col-sm-7 col-md-7 col-lg-12">
						<h1 class="page-title txt-color-blueDark">
							
							<!-- PAGE HEADER -->
							
							
						</h1>

						
					</div>
					<!-- end col -->
					
					<!-- right side of the page with the sparkline graphs -->
					
					
				</div>
				<!-- end row -->

				<div class="jarviswidget" id="wid-id-1" data-widget-colorbutton="false" data-widget-editbutton="false" data-widget-custombutton="false" role="widget">
                
                <!-- widget div-->
                <div>
                    <!-- widget edit box -->
                    <div class="jarviswidget-editbox">
                        <!-- This area used as dropdown edit box -->
                    </div>
                    <!-- end widget edit box -->
                    <!-- widget content -->
                    <div class="widget-body no-padding">
                        
                            @csrf
                            <fieldset>
                                <div class="row">
                                
                                    <!--<p style="font-size: 30px; text-align: center; font-weight: 700; color: red;">UNDER CONSTRUCTION</p>-->
                                    <!--<img src"https://developments.tekgeeks.net/dsi_inventory/images/welcome_img.jpg" alt="" class="img-responsive center-block">-->
                                    <img src="{{url('images/welcome_img.jpg')}}">
                                    
                                </div>
                               
                             
                           
                               
                                
                                <div class=" cleafix"></div>
                                
                                <br>
                               
                            </fieldset>

                        
                    </div>
                    <!-- end widget content -->
                </div>
                <!-- end widget div -->
            </div>



			</div>
    </div>
    <x-slot name="script">

        <!-- Morris Chart Dependencies -->
        {{-- <script src="{{ asset('public/js/plugin/morris/raphael.min.js') }}"></script>
        <script src="{{ asset('public/js/plugin/morris/morris.min.js') }}"></script>
        <script src="{{ asset('public/js/plugin/chartjs/chart.min.js') }}"></script> --}}
        <script src="https://lcms.tekgeeks.net/public/js/plugin/morris/raphael.min.js"></script>
        <script src="https://lcms.tekgeeks.net/public/js/plugin/morris/morris.min.js"></script>
        <script src="https://lcms.tekgeeks.net/public/js/plugin/chartjs/chart.min.js"></script>

        <script>
			
			/* DO NOT REMOVE : GLOBAL FUNCTIONS!
			 *
			 * pageSetUp(); WILL CALL THE FOLLOWING FUNCTIONS
			 *
			 * // activate tooltips
			 * $("[rel=tooltip]").tooltip();
			 *
			 * // activate popovers
			 * $("[rel=popover]").popover();
			 *
			 * // activate popovers with hover states
			 * $("[rel=popover-hover]").popover({ trigger: "hover" });
			 *
			 * // activate inline charts
			 * runAllCharts();
			 *
			 * // setup widgets
			 * setup_widgets_desktop();
			 *
			 * // run form elements
			 * runAllForms();
			 *
			 ********************************
			 *
			 * pageSetUp() is needed whenever you load a page.
			 * It initializes and checks for all basic elements of the page
			 * and makes rendering easier.
			 *
			 */

			pageSetUp();
			
			/*
			 * ALL PAGE RELATED SCRIPTS CAN GO BELOW HERE
			 * eg alert("my home function");
			 * 
			 * var pagefunction = function() {
			 *   ...
			 * }
			 * loadScript("js/plugin/_PLUGIN_NAME_.js", pagefunction);
			 * 
			 * TO LOAD A SCRIPT:
			 * var pagefunction = function (){ 
			 *  loadScript(".../plugin.js", run_after_loaded);	
			 * }
			 * 
			 * OR you can load chain scripts by doing
			 * 
			 * loadScript(".../plugin.js", function(){
			 * 	 loadScript("../plugin.js", function(){
			 * 	   ...
			 *   })
			 * });
			 */
			
			// pagefunction

			var PieConfig;

			/* flot chart colors default */
			var $chrt_border_color = "#efefef";
			var $chrt_grid_color = "#DDD"
			var $chrt_main = "#E24913";			/* red       */
			var $chrt_second = "#6595b4";		/* blue      */
			var $chrt_third = "#FF9F01";		/* orange    */
			var $chrt_fourth = "#7e9d3a";		/* green     */
			var $chrt_fifth = "#BD362F";		/* dark red  */
			var $chrt_mono = "#000";

			var pagefunction = function() {
				// clears the variable if left blank

				
				/* sales chart */

				var myRandomNumber = function () {
					return ( Math.floor((Math.random() * 80) + 400) )
				}


				var saleschart = function() {

					if ($("#saleschart").length) {
						var d = [[1197068400000, 1086], [1197154800000, 676], [1197241200000, 1205], [1197327600000, 906], [1197414000000, 710], [1197500400000, 639], [1197586800000, 540], [1197673200000, 435], [1197759600000, 301], [1197846000000, 575], [1197932400000, 481], [1198018800000, 591], [1198105200000, 608], [1198191600000, 459], [1198450800000, 686], [1198537200000, 279], [1198623600000, 449], [1198710000000, 468], [1198796400000, 392], [1198882800000, 282], [1198969200000, 208], [1199055600000, 229], [1199142000000, 177], [1199228400000, 374], [1199314800000, 436], [1199401200000, 404], [1199487600000, 253], [1199574000000, 218], [1199660400000, 476], [1199746800000, 462], [1199833200000, 500], [1199919600000, 700], [1200006000000, 750], [1200092400000, 600], [1200178800000, 500], [1200265200000, 900], [1200351600000, 930], [1200438000000, 1200], [1200524400000, 980], [1200610800000, 950], [1200697200000, 900], [1200783600000, 1000], [1200870000000, 1050], [1200956400000, 1150], [1201042800000, 1100], [1201129200000, 1200], [1201215600000, 1300]];

						var e = [[1197068400000, 86], [1197154800000, 76], [1197241200000, 55], [1197327600000, 46], [1197414000000, 70], [1197500400000, 39], [1197586800000, 40], [1197673200000, 35], [1197759600000, 11], [1197846000000, 75], [1197932400000, 81], [1198018800000, 91], [1198105200000, 80], [1198191600000, 89], [1198450800000, 86], [1198537200000, 99], [1198623600000, 149], [1198710000000, 46], [1198796400000, 92], [1198882800000, 82], [1198969200000, 28], [1199055600000, 29], [1199142000000, 77], [1199228400000, 37], [1199314800000, 36], [1199401200000, 44], [1199487600000, 25], [1199574000000, 28], [1199660400000, 47], [1199746800000, 46], [1199833200000, 50], [1199919600000, 70], [1200006000000, 75], [1200092400000, 60], [1200178800000, 50], [1200265200000, 200], [1200351600000, 90], [1200438000000, 100], [1200524400000, 98], [1200610800000, 95], [1200697200000, 90], [1200783600000, 100], [1200870000000, 150], [1200956400000, 150], [1201042800000, 110], [1201129200000, 120], [1201215600000, 130]];

						var f = [[1197068400000, 16], [1197154800000, 71], [1197241200000, 51], [1197327600000, 41], [1197414000000, 70], [1197500400000, 39], [1197586800000, 10], [1197673200000, 31], [1197759600000, 11], [1197846000000, 71], [1197932400000, 81], [1198018800000, 91], [1198105200000, 81], [1198191600000, 18], [1198450800000, 86], [1198537200000, 199], [1198623600000, 119], [1198710000000, 11], [1198796400000, 91], [1198882800000, 81], [1198969200000, 21], [1199055600000, 129], [1199142000000, 77], [1199228400000, 37], [1199314800000, 16], [1199401200000, 104], [1199487600000, 121], [1199574000000, 21], [1199660400000, 47], [1199746800000, 46], [1199833200000, 51], [1199919600000, 100], [1200006000000, 71], [1200092400000, 16], [1200178800000, 50], [1200265200000, 100], [1200351600000, 91], [1200438000000, 100], [1200524400000, 91], [1200610800000, 19], [1200697200000, 90], [1200783600000, 100], [1200870000000, 115], [1200956400000, 110], [1201042800000, 110], [1201129200000, 120], [1201215600000, 110]];

						var g = [[1197068400000, 206], [1197154800000, 221], [1197241200000, 221], [1197327600000, 211], [1197414000000, 230], [1197500400000, 219], [1197586800000, 230], [1197673200000, 211], [1197759600000, 201], [1197846000000, 231], [1197932400000, 211], [1198018800000, 211], [1198105200000, 211], [1198191600000, 218], [1198450800000, 216], [1198537200000, 329], [1198623600000, 309], [1198710000000, 201], [1198796400000, 201], [1198882800000, 201], [1198969200000, 221], [1199055600000, 276], [1199142000000, 210], [1199228400000, 127], [1199314800000, 216], [1199401200000, 304], [1199487600000, 321], [1199574000000, 243], [1199660400000, 207], [1199746800000, 246], [1199833200000, 251], [1199919600000, 300], [1200006000000, 232], [1200092400000, 213], [1200178800000, 200], [1200265200000, 300], [1200351600000, 291], [1200438000000, 300], [1200524400000, 211], [1200610800000, 241], [1200697200000, 200], [1200783600000, 300], [1200870000000, 315], [1200956400000, 210], [1201042800000, 312], [1201129200000, 300], [1201215600000, 300]];
					
						for (var i = 0; i < d.length; ++i)
							d[i][0] += 60 * 60 * 1000;
					
						function weekendAreas(axes) {
							var markings = [];
							var d = new Date(axes.xaxis.min);
							// go to the first Saturday
							d.setUTCDate(d.getUTCDate() - ((d.getUTCDay() + 1) % 7))
							d.setUTCSeconds(0);
							d.setUTCMinutes(0);
							d.setUTCHours(0);
							var i = d.getTime();
							do {
								// when we don't set yaxis, the rectangle automatically
								// extends to infinity upwards and downwards
								markings.push({
									xaxis : {
										from : i,
										to : i + 2 * 24 * 60 * 60 * 1000
									}
								});
								i += 7 * 24 * 60 * 60 * 1000;
							} while (i < axes.xaxis.max);
					
							return markings;
						}
					
						var options = {
							xaxis : {
								mode : "time",
								tickLength : 5
							},
							series : {
								lines : {
									show : true,
									lineWidth : 1,
									fill : true,
									fillColor : {
										colors : [{
											opacity : 0.1
										}, {
											opacity : 0.15
										}]
									}
								},
			                   //points: { show: true },
								shadowSize : 0
							},
							selection : {
								mode : "x"
							},
							grid : {
								hoverable : true,
								clickable : true,
								tickColor : $chrt_border_color,
								borderWidth : 0,
								borderColor : $chrt_border_color,
							},
							tooltip : false,
							colors : [$chrt_second, $chrt_third, $chrt_main, $chrt_fourth],
					
						};
					
						plot_1 = $.plot($("#saleschart"), [d,e,f,g], options);


					};

				}

				var linechart = function() {
					if ($("#linechart").length) {
						var d = [[1197068400000, myRandomNumber()], [1197154800000, myRandomNumber()], [1197241200000, myRandomNumber()], [1197327600000, myRandomNumber()], [1197414000000, myRandomNumber()], [1197500400000, myRandomNumber()], [1197586800000, myRandomNumber()], [1197673200000, myRandomNumber()], [1197759600000, myRandomNumber()], [1197846000000, myRandomNumber()], [1197932400000, myRandomNumber()], [1198018800000, myRandomNumber()], [1198105200000, myRandomNumber()], [1198191600000, myRandomNumber()], [1198450800000, myRandomNumber()], [1198537200000, myRandomNumber()], [1198623600000, myRandomNumber()], [1198710000000, myRandomNumber()], [1198796400000, myRandomNumber()], [1198882800000, myRandomNumber()], [1198969200000, myRandomNumber()], [1199055600000, myRandomNumber()], [1199142000000, myRandomNumber()], [1199228400000, myRandomNumber()], [1199314800000, myRandomNumber()], [1199401200000, myRandomNumber()], [1199487600000, myRandomNumber()], [1199574000000, myRandomNumber()], [1199660400000, myRandomNumber()], [1199746800000, myRandomNumber()], [1199833200000, myRandomNumber()], [1199919600000, myRandomNumber()], [1200006000000, myRandomNumber()], [1200092400000, myRandomNumber()], [1200178800000, myRandomNumber()], [1200265200000, myRandomNumber()], [1200351600000, myRandomNumber()], [1200438000000, myRandomNumber()], [1200524400000, myRandomNumber()], [1200610800000, myRandomNumber()], [1200697200000, myRandomNumber()], [1200783600000, myRandomNumber()], [1200870000000, myRandomNumber()], [1200956400000, myRandomNumber()], [1201042800000, myRandomNumber()], [1201129200000, myRandomNumber()], [1201215600000, 900]];

						var e = [[1197068400000, 400], [1197154800000, myRandomNumber()], [1197241200000, myRandomNumber()], [1197327600000, myRandomNumber()], [1197414000000, myRandomNumber()], [1197500400000, myRandomNumber()], [1197586800000, myRandomNumber()], [1197673200000, myRandomNumber()], [1197759600000, myRandomNumber()], [1197846000000, myRandomNumber()], [1197932400000, myRandomNumber()], [1198018800000, myRandomNumber()], [1198105200000, 400], [1198191600000, myRandomNumber()], [1198450800000, myRandomNumber()], [1198537200000, myRandomNumber()], [1198623600000, myRandomNumber()], [1198710000000, myRandomNumber()], [1198796400000, myRandomNumber()], [1198882800000, myRandomNumber()], [1198969200000, myRandomNumber()], [1199055600000, myRandomNumber()], [1199142000000, myRandomNumber()], [1199228400000, myRandomNumber()], [1199314800000, myRandomNumber()], [1199401200000, myRandomNumber()], [1199487600000, myRandomNumber()], [1199574000000, 400], [1199660400000, myRandomNumber()], [1199746800000, myRandomNumber()], [1199833200000, myRandomNumber()], [1199919600000, myRandomNumber()], [1200006000000, myRandomNumber()], [1200092400000, myRandomNumber()], [1200178800000, myRandomNumber()], [1200265200000, myRandomNumber()], [1200351600000, myRandomNumber()], [1200438000000, myRandomNumber()], [1200524400000, myRandomNumber()], [1200610800000, myRandomNumber()], [1200697200000, myRandomNumber()], [1200783600000, myRandomNumber()], [1200870000000, 400], [1200956400000, myRandomNumber()], [1201042800000, myRandomNumber()], [1201129200000, myRandomNumber()], [1201215600000, 500]];
					
						for (var i = 0; i < d.length; ++i)
							d[i][0] += 60 * 60 * 1000;
					
						function weekendAreas(axes) {
							var markings = [];
							var d = new Date(axes.xaxis.min);
							// go to the first Saturday
							d.setUTCDate(d.getUTCDate() - ((d.getUTCDay() + 1) % 7))
							d.setUTCSeconds(0);
							d.setUTCMinutes(0);
							d.setUTCHours(0);
							var i = d.getTime();
							do {
								// when we don't set yaxis, the rectangle automatically
								// extends to infinity upwards and downwards
								markings.push({
									xaxis : {
										from : i,
										to : i + 2 * 24 * 60 * 60 * 1000
									}
								});
								i += 7 * 24 * 60 * 60 * 1000;
							} while (i < axes.xaxis.max);
					
							return markings;
						}
					
						var options = {
							xaxis : {
								mode : "time",
								tickLength : 5
							},
							series : {
								lines : {
									show : true,
									lineWidth : 2,
									fill : false,
									fillColor : {
										colors : [{
											opacity : 0.1
										}, {
											opacity : 0.15
										}]
									}
								},
			                   //points: { show: true },
								shadowSize : 0
							},
							selection : {
								mode : "x"
							},
							grid : {
								hoverable : true,
								clickable : true,
								tickColor : $chrt_border_color,
								borderWidth : 0,
								borderColor : $chrt_border_color,
							},
							tooltip : false,
							colors : [$chrt_second, $chrt_third],
					
						};
					
						plot_1 = $.plot($("#linechart"), [d,e], options);


					};
				}
				
				/* end sales chart */

				var randomScalingFactor = function() {
		            return Math.round(Math.random() * 100);
		            //return 0;
		        };

				/*
				 * VECTOR MAP
				 */
				
				data_array = {
				    "US": 4977,
				    "AU": 4873,
				    "IN": 3671,
				    "BR": 2476,
				    "TR": 1476,
				    "CN": 146,
				    "CA": 134,
				    "BD": 100
				};

				function renderVectorMap() {
				    $('#vector-map').vectorMap({
				        map: 'world_mill_en',
				        backgroundColor: '#fff',
				        regionStyle: {
				            initial: {
				                fill: '#c4c4c4'
				            },
				            hover: {
				                "fill-opacity": 1
				            }
				        },
				        series: {
				            regions: [{
				                values: data_array,
				                scale: ['#85a8b6', '#4d7686'],
				                normalizeFunction: 'polynomial'
				            }]
				        },
				        onRegionLabelShow: function (e, el, code) {
				            if (typeof data_array[code] == 'undefined') {
				                e.preventDefault();
				            } else {
				                var countrylbl = data_array[code];
				                el.html(el.html() + ': ' + countrylbl + ' visits');
				            }
				        }
				    });
				}

				function renderPie(){

				    // pie chart example
				    PieConfig = {
				        type: 'pie',
				        data: {
				            datasets: [{
				                data: [
				                    randomScalingFactor(),
				                    randomScalingFactor(),
				                    randomScalingFactor(),
				                    randomScalingFactor(),
				                    randomScalingFactor(),
				                ],
				                backgroundColor: [
				                    "#3b5998",
				                    "#8b9dc3",
				                    "#dfe3ee",
				                    "#b0bcd5",
				                    "#293e6a",
				                ],
				            }],
				            labels: [
				                "(14-17)",
				                "(18-23)",
				                "(24-30)",
				                "(31-37)",
				                "(38-55)"
				            ]
				        },
				        options: {
				            responsive: true
				        }
				    };

					myPie = new Chart(document.getElementById("pieChart"), PieConfig);
				}

				renderVectorMap();
				renderPie();
				saleschart();
				linechart();

			};
			
			// end pagefunction

			// destroy generated instances 
			// pagedestroy is called automatically before loading a new page
			// only usable in AJAX version!

			// end destroy
			
			// run pagefunction
			pagefunction();

			
		</script>

		<!-- Your GOOGLE ANALYTICS CODE Below -->
		<script>
			var _gaq = _gaq || [];
				_gaq.push(['_setAccount', 'UA-XXXXXXXX-X']);
				_gaq.push(['_trackPageview']);
			
			(function() {
				var ga = document.createElement('script');
				ga.type = 'text/javascript';
				ga.async = true;
				ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
				var s = document.getElementsByTagName('script')[0];
				s.parentNode.insertBefore(ga, s);
			})();

		</script>
    </x-slot>
</x-app-layout>
