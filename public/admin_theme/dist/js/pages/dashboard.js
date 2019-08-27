/*
 * Author: Abdullah A Almsaeed
 * Date: 4 Jan 2014
 * Description:
 *      This is a demo file used only for the main dashboard (index.html)
 **/

$('document').ready(function() {
  'use strict';

  // Make the dashboard widgets sortable Using jquery UI

  $('.connectedSortable').sortable({
    placeholder: 'sort-highlight',
    connectWith: '.connectedSortable',
    handle: '.box-header, .nav-tabs',
    forcePlaceholderSize: true,
    zIndex: 999999,
    receive: function(i,el) {
        if(el.sender.parent().attr('class') == 'modal_add_widget'){
        let render = el.item.find('.widget-html');
            // el.item.html('<div class="ui-sortable-handle">'+render.html()+'</div>');
        el.item.html(` <div id="${el.item.attr('id')}" style="position: relative" class="box--wall" data-title="${el.item.attr('data-title') || 'name'}">
                      <div class="card panel panel-default dashboard--panel">
                        <div class="card-header panel-heading box-header">
  <h4 class="panel-title">${render.find('.widget-view').attr('data-title')}</h4>
  <div class="panel-heading-btn">
  <a class="max--widget btn btn-max">
  <i class="fa fa-expand" aria-hidden="true"></i>
  </a>
  <a class="min--widget btn btn-minus">
  <i class="fa fa-minus" aria-hidden="true"></i>
  </a>
  <a class="delete-widget btn btn-del">
  <i class="fa fa-times" aria-hidden="true"></i>
  </a>
  </div>
    </div>
  <div class="card-body panel-body"><div class="ui-sortable-handle">
                  ${render.html()}
                </div></div>
</div>
                
            </div>`);
      }

    },
    update: function(event, ui) {
      var section = $(this).data('placement');
      var productOrder = $(this).sortable('toArray').toString();

        if(section != undefined && $(this).sortable('toArray').length > 0){
        $.ajax({
          url: "/admin/dashboard-save",
          type: 'POST',
          data: {placeholder : section, widgets: productOrder},
          headers: {
            "X-CSRF-TOKEN": $("input[name='_token']").val()
          },
          success: function (data) {
            if (!data.error) {

            }
          },
          error: function (data) {

          }
        });
      }
      // $("#sortable-9").text (productOrder+ ' -- ' + section);
    },
      // beforeStop: function(ev, ui) {
      //     console.log($(ui.placeholder).parent(), 'placeholder');
      //
      //     $(ui.placeholder).parent().children().length>2 && $(ui.placeholder).parent().sortable( "cancel");
      // }
  });
  $(".connectedSortable").disableSelection();
  $("body").on('click','.delete-widget',function () {
    let $_this = $(this);
    var section = $(this).closest('.connectedSortable').data('placement');
    var key = $(this).closest('.box--wall').attr('id');
    var name = $(this).closest('.box--wall').find('.widget-view').attr('data-title');
    var el = $(this).closest('.box--wall').find('.widget-view')
    if($('.dashboard--panel').hasClass('fixed-widget')) {
      $(".connectedSortable").sortable('enable');
    };
    $.ajax({
      url: "/admin/dashboard-delete",
      type: 'POST',
      data: {placeholder : section, key: key},
      headers: {
        "X-CSRF-TOKEN": $("input[name='_token']").val()
      },
      success: function (data) {
        if (!data.error) {
          $('.modal_add_widget>#connectedSortable')
              .append(`<div id="${key}">
                         <div class="box-header ui-sortable-handle">
                            ${name}
                         </div>
                         <div class="widget-html hide">
                           ${el[0].outerHTML}
                         </div>
                       </div>`)
          $_this.closest('.box--wall').remove();
        }
      },
      error: function (data) {

      }
    });
  });

  $('.connectedSortable .box-header, .connectedSortable .nav-tabs-custom').css('cursor', 'move');

  // jQuery UI sortable for the todo list
  $('.todo-list').sortable({
    placeholder: 'sort-highlight',
    handle: '.handle',
    forcePlaceholderSize: true,
    zIndex: 999999
  });

  // bootstrap WYSIHTML5 - text editor
  $('.textarea').wysihtml5();

  $('.daterange').daterangepicker({
    ranges: {
      'Today': [moment(), moment()],
      'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
      'Last 7 Days': [moment().subtract(6, 'days'), moment()],
      'Last 30 Days': [moment().subtract(29, 'days'), moment()],
      'This Month': [moment().startOf('month'), moment().endOf('month')],
      'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
    },
    startDate: moment().subtract(29, 'days'),
    endDate: moment()
  }, function (start, end) {
    window.alert('You chose: ' + start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
  });

    /* jQueryKnob */
  $('.knob').knob();

  // jvectormap data
  // var visitorsData = JSON.parse($('#map_box_data').val());

  var visitorsData = {
    US: 398, // USA
    SA: 400, // Saudi Arabia
    CA: 1000, // Canada
    DE: 500, // Germany
    FR: 760, // France
    CN: 300, // China
    AU: 700, // Australia
    BR: 600, // Brazil
    IN: 800, // India
    GB: 320, // Great Britain
    RU: 3000, // Russia
    AM: 30000 // Russia
  };
  // World map by jvectormap
  $('#world-map').vectorMap({
    map: 'world_mill_en',
    backgroundColor: 'transparent',
    regionStyle: {
      initial: {
        fill: '#e4e4e4',
        'fill-opacity': 1,
        stroke: 'none',
        'stroke-width': 0,
        'stroke-opacity': 1
      }
    },
    series: {
      regions: [
        {
          values: visitorsData,
          scale: ['#92c1dc', '#ebf4f9'],
          normalizeFunction: 'polynomial'
        }
      ]
    },
    onRegionLabelShow: function (e, el, code) {
      if (typeof visitorsData[code] != 'undefined')
        el.html(el.html() + ': ' + visitorsData[code] + ' new visitors');
    }
  });

  // // Sparkline charts
  // var myvalues = [1000, 1200, 920, 927, 931, 1027, 819, 930, 1021];
  // $('#sparkline-1').sparkline(myvalues, {
  //   type     : 'line',
  //   lineColor: '#92c1dc',
  //   fillColor: '#ebf4f9',
  //   height   : '50',
  //   width    : '80'
  // });
  // myvalues = [515, 519, 520, 522, 652, 810, 370, 627, 319, 630, 921];
  // $('#sparkline-2').sparkline(myvalues, {
  //   type     : 'line',
  //   lineColor: '#92c1dc',
  //   fillColor: '#ebf4f9',
  //   height   : '50',
  //   width    : '80'
  // });
  // myvalues = [15, 19, 20, 22, 33, 27, 31, 27, 19, 30, 21];
  // $('#sparkline-3').sparkline(myvalues, {
  //   type     : 'line',
  //   lineColor: '#92c1dc',
  //   fillColor: '#ebf4f9',
  //   height   : '50',
  //   width    : '80'
  // });

  // The Calender
  $('#calendar').datepicker();

  // SLIMSCROLL FOR CHAT WIDGET
  $('#chat-box').slimScroll({
    height: '250px'
  });

    /* Morris.js Charts */
  // Sales chart
  // var area = new Morris.Area({
  //     element: 'revenue-chart',
  //     resize: true,
  //     data: [
  //         {y: '2011 Q1', item1: 2666, item2: 2666},
  //         {y: '2011 Q2', item1: 2778, item2: 2294},
  //         {y: '2011 Q3', item1: 4912, item2: 1969},
  //         {y: '2011 Q4', item1: 3767, item2: 3597},
  //         {y: '2012 Q1', item1: 6810, item2: 1914},
  //         {y: '2012 Q2', item1: 5670, item2: 4293},
  //         {y: '2012 Q3', item1: 4820, item2: 3795},
  //         {y: '2012 Q4', item1: 15073, item2: 5967},
  //         {y: '2013 Q1', item1: 10687, item2: 4460},
  //         {y: '2013 Q2', item1: 8432, item2: 5713}
  //     ],
  //     xkey: 'y',
  //     ykeys: ['item1', 'item2'],
  //     labels: ['Item 1', 'Item 2'],
  //     lineColors: ['#a0d0e0', '#3c8dbc'],
  //     hideHover: 'auto'
  // });
  // var line = new Morris.Line({
  //     element: 'line-chart',
  //     resize: true,
  //     data: [
  //         {y: '2011 Q1', item1: 2666},
  //         {y: '2011 Q2', item1: 2778},
  //         {y: '2011 Q3', item1: 4912},
  //         {y: '2011 Q4', item1: 3767},
  //         {y: '2012 Q1', item1: 6810},
  //         {y: '2012 Q2', item1: 5670},
  //         {y: '2012 Q3', item1: 4820},
  //         {y: '2012 Q4', item1: 15073},
  //         {y: '2013 Q1', item1: 10687},
  //         {y: '2013 Q2', item1: 8432}
  //     ],
  //     xkey: 'y',
  //     ykeys: ['item1'],
  //     labels: ['Item 1'],
  //     lineColors: ['#efefef'],
  //     lineWidth: 2,
  //     hideHover: 'auto',
  //     gridTextColor: '#fff',
  //     gridStrokeWidth: 0.4,
  //     pointSize: 4,
  //     pointStrokeColors: ['#efefef'],
  //     gridLineColor: '#efefef',
  //     gridTextFamily: 'Open Sans',
  //     gridTextSize: 10
  // });
  //
  // // Donut Chart
  // var donut = new Morris.Donut({
  //     element: 'sales-chart',
  //     resize: true,
  //     colors: ['#3c8dbc', '#f56954', '#00a65a'],
  //     data: [
  //         {label: 'Download Sales', value: 12},
  //         {label: 'In-Store Sales', value: 30},
  //         {label: 'Mail-Order Sales', value: 20}
  //     ],
  //     hideHover: 'auto'
  // });

  // Fix for charts under tabs
  $('.box ul.nav a').on('shown.bs.tab', function () {
    area.redraw();
    donut.redraw();
    line.redraw();
  });

    /* The todo list plugin */
  $('.todo-list').todoList({
    onCheck: function () {
      window.console.log($(this), 'The element has been checked');
    },
    onUnCheck: function () {
      window.console.log($(this), 'The element has been unchecked');
    }
  });
  $('#sendEmailQuickEmail').on('click', function () {
    let data = $('form#quick-email').serialize();

    $.ajax({
      type: "post",
      url: "/admin/quick-email",
      cache: false,
      datatype: "json",
      data: data,
      headers: {
        "X-CSRF-TOKEN": $("meta[name='csrf-token']").attr("content")
      },
      success: (function (data) {
        if (!data.error) {
          document.getElementById("form#quick-email").reset();
        }
      })

    });
  });

  $('body').on('click', '.min--widget',function () {
    $(this).closest('.dashboard--panel').find('.panel-body').slideToggle('hide');
    $(this).find('i').toggleClass('fa-minus fa-plus');
  });
  $('body').on('click', '.max--widget', function() {
    $(this).closest('.dashboard--panel').toggleClass('fixed-widget');
    $(this).find('i').toggleClass('fa-expand fa-compress');
    $(this).closest('body').toggleClass('overhidden');
    if($('.dashboard--panel').hasClass('fixed-widget')) {
      $(".connectedSortable").sortable('disable');
    } else {
      $(".connectedSortable").sortable('enable');
    }
  });
  // {{--open new widget sidebar--}}
  $('.open_dashboard_widget').on('click', function () {
    $('.dashboard_modal_add_widget').toggleClass('active');
  });

  $('body').on('click', function (e) {
    if (e.target !==  $('.open_dashboard_widget')[0] &&
        $('.dashboard_modal_add_widget').hasClass('active') &&
        e.target !== $('.modal_add_widget')[0]) {
      $('.dashboard_modal_add_widget').removeClass('active');
    }
  });

  $('.close-widget-modal').on('click', function () {
    $('.dashboard_modal_add_widget').removeClass('active');
  });

  // {{--inner widget btn--}}
  $('.btn-for-widget').on('click', function () {
    $(this).find('i').toggleClass('fa-plus fa-minus');
  });
});
