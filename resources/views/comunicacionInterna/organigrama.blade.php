@extends('adminlte::layouts.app')

@section('htmlheader_title')
	{{ trans('message.ci.organizationchart') }}
@endsection

@section('contentheader_title')
	{{ trans('message.ci.organizationchart') }}
@endsection

@section('contentheader_level_here')
	{{ trans('message.ci.organizationchart') }}
@endsection

@section('main-content')
	<div class="container-fluid spark-screen">

        <div class="row">

            <div class="col-md-12">
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item active"><a class="nav-link active" id="tab1" href="#tab_1" data-toggle="tab" role="tab" aria-selected="true" aria-expanded="true">Lista</a>                    </li>
                        <li class="nav-item"><a href="#tab_2" data-toggle="tab" aria-expanded="false">Árbol</a></li>
                    </ul>

                    <div class="tab-content" id="myTabContent">

                        <div class="tab-pane active" id="tab_1" role="tabpanel" role="tabpanel" aria-labelledby="tab1">
                            <div class="row">
                                {!! $data['list2'] !!}
                            </div>
                        </div>

                        <div class="tab-pane fade" id="tab_2">
                            <div class="row">
                                <div style="height:500px;width:1000px;position:relative;">
                                    <div style="max-width:100%;overflow:auto;">
                                        <div style="height:450px;width:2500px">
                                            <div class="organigrama">
                                                {!! $data['list'] !!}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>
            </div>

        </div>

    </div>

    <!-- Modal -->
    <div class="modal fade" id="modelId" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header bg-yellow">
                    <h5 class="modal-title"></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                </div>
                <div class="modal-body">
                    <div class="container">
                        <div class="row">
                            <div class="modal-photo col-12 col-md-6">

                            </div>
                            <div class="modal-info col-12 col-md-6">

                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('main-script')
<script type="text/javascript">

    $(document).ready(function(){
        $("#buscador").on("keyup", function() {
            var value = $(this).val().toLowerCase();

        $("#accordionExample .encont").filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
        });

        if($(".encont").filter(":visible").length == 0){
            $("#no_resultado").css("display", "block");
        }else{
            $("#no_resultado").css("display", "none");
         }

      });
    });

    $('.info').click(function(){

        var img = $(this).data('img');
        var name = $(this).data('name');
        var jobPosition = $(this).data('jobposition');
        var office = $(this).data('office');
        var email = $(this).data('email');
        var phone = $(this).data('phone');
        var mobile = $(this).data('mobile');
        var hobbies = $(this).data('hobbies');
        var department = $(this).data('department');

        $('.modal-header').empty();
        $('.modal-photo').empty();
        $('.modal-info').empty();

        $('.modal-header').append('<h2 class="m-0">'+name+' - '+jobPosition+' - '+department+'</h2>');
        $('.modal-photo').append('<img class="img-fluid" src="'+img+'" alt="'+img+'">');
        $('.modal-info').append(
            '<p>'+office+'</p>'+
            '<p>'+email+'</p>'+
            '<p>'+phone+'</p>'+
            '<p>'+hobbies+'</p>'+
            '<p>'+department+'</p>'+
            ''
        );
    });

    var genericCloseBtnHtml = '<a onclick="$(this).closest(\'div.popover\').popover(\'hide\');" type="button" class="close" aria-hidden="true">&times;</a>';
    $(function(){
        $('[data-toggle="popover"]').popover({
            trigger:'click',
            html: true,
            title : genericCloseBtnHtml,
            callback: function () {
                $("#img_user").addClass("img-rounded img-responsive");
            }
        });
        $(document).on("click", ".popover .close" , function(){
            $(this).parents(".popover").popover('hide');
        });
    });

$.fn.extend({
    treeview:   function() {
        return this.each(function() {
            // Initialize the top levels;
            var tree = $(this);

            tree.addClass('treeview-tree');
            tree.find('li').each(function() {
                var stick = $(this);
            });

			tree.find('li').each(function () {


				var branch = $(this); //li with children ul
                //console.log($(this).children('ul').children('li').attr('class'));
				if($(this).children('ul').length > 0){

					// branch.prepend("<i class='tree-indicator glyphicon glyphicon-folder-open'></i>");
					branch.prepend("<i class='tree-indicator fa fa-users'></i>");
					branch.addClass('tree-branch');
					branch.on('click', function (e) {
						if (this == e.target) {
							var icon = $(this).children('i:first');

							icon.toggleClass("<i class='fa fa-chevron-down");
							$(this).children().children().toggle();
						}

					})
					branch.children().children().toggle();

					/**
					 *  The following snippet of code enables the treeview to
					 *  function when a button, indicator or anchor is clicked.
					 *
					 *  It also prevents the default function of an anchor and
					 *  a button from firing.
					 */
					branch.children('.tree-indicator, button, i').click(function(e) {
						branch.click();
						e.preventDefault();
					});

				}else{
					branch.prepend("<i class='tree-indicator ' style='color: blue !important'></i>");
				}

			 });

        });
    }
});

/**
 *  The following snippet of code automatically converst
 *  any '.treeview' DOM elements into a treeview component.
 */
$(window).on('load', function () {

    $('.treeview').each(function () {
        var tree = $(this);
        tree.treeview();
    });
    $(document).ready(function(){
    $("#open").trigger("click");
});
});
</script>
@endsection
@section('main-css')
    <style type="text/css">
        .organigrama * {
            margin: 0px;
            padding: 0px;
        }

        .organigrama ul {
            padding-top: 20px;
            position: relative;
        }

        .organigrama li {
            float: left;
            text-align: center;
            list-style-type: none;
            padding: 20px 5px 0px 5px;
            position: relative;
        }

        .organigrama li::before, .organigrama li::after {
            content: '';
            position: absolute;
            top: 0px;
            right: 50%;
            border-top: 1px solid #605ca8;
            width: 50%;
            height: 20px;
        }

        .organigrama li::after{
            right: auto;
            left: 50%;
            border-left: 1px solid #605ca8;
        }

        .organigrama li:only-child::before, .organigrama li:only-child::after {
            display: none;
        }

        .organigrama li:only-child {
            padding-top: 0;
        }

        .organigrama li:first-child::before, .organigrama li:last-child::after{
            border: 0 none;
        }

        .organigrama li:last-child::before{
            border-right: 1px solid #605ca8;
            -webkit-border-radius: 0 5px 0 0;
            -moz-border-radius: 0 5px 0 0;
            border-radius: 0 5px 0 0;
        }

        .organigrama li:first-child::after{
            border-radius: 5px 0 0 0;
            -webkit-border-radius: 5px 0 0 0;
            -moz-border-radius: 5px 0 0 0;
        }

        .organigrama ul ul::before {
            content: '';
            position: absolute;
            top: 0;
            left: 50%;
            border-left: 1px solid #605ca8;
            width: 0;
            height: 20px;
        }

        .organigrama li a {
            border: 1px solid #605ca8;
            padding: 1em 0.75em;
            text-decoration: none;
            color: #333;
            background-color: rgba(255,255,255,0.5);
            font-family: arial, verdana, tahoma;
            font-size: 0.85em;
            display: inline-block;
            border-radius: 5px;
            -webkit-border-radius: 5px;
            -moz-border-radius: 5px;
            -webkit-transition: all 500ms;
            -moz-transition: all 500ms;
            transition: all 500ms;
        }

        .organigrama li a:hover {
            border: 1px solid #fff;
            color: #ddd;
            background-color: rgba(96,92,168,0.7);
            display: inline-block;
        }

        .organigrama > ul > li > a {
            font-size: 1em;
            font-weight: bold;
        }


        [hidden] {
            display: none !important;
        }
         /*ORGANIGRAMA*/
         .scroll {
            max-width: auto;
            overflow-x: auto;
        }

         .popover-title .close{
            position: relative;
            bottom: 3px;
        }
         .close:hover{
            cursor: pointer;
         }
         div.treeview ul:first-child:before {
            display: none;
        }
        .treeview, .treeview ul {
            margin:0;
            padding:0;
            list-style:none;
            color: #369;
        }
        .treeview ul {
            margin-left:1em;
            position:relative
        }
        .treeview ul ul {
            margin-left:.5em
        }
        .treeview ul:before {
            content:"";
            display:block;
            width:0;
            position:absolute;
            top:0;
            left:0;
            border-left:1px solid;

            /* creates a more theme-ready standard for the bootstrap themes */
            bottom:15px;
        }
        .treeview li {
            margin:0;
            padding:0 1em;
            line-height:2em;
            font-weight:700;
            position:relative
        }

        .treeview ul .c1:before{
            width:10px;
        }

        .treeview ul .c2:before{
            width:32px;
        }

        .treeview ul .c3:before{
            width:55px;
        }

        .treeview ul .c4:before{
            width:85px;
        }

        .treeview ul .c5:before{
            width:125px;
        }

        .treeview ul .c6:before{
            width:175px;
        }

        .treeview ul .c7:before{
            width:228px;
        }

        .treeview ul .c8:before{
            width:250px;
        }

        .treeview ul li:before {
            content:"";
            display:block;
            height:0;
            border-top:1px dashed;
            border-width: 3px;
            margin-top:-1px;
            position:absolute;
            top:1em;
            left:0
        }
        .tree-indicator {
            margin-right:5px;

            cursor:pointer;
        }
        .treeview li a {
            text-decoration: none;
            /*color:inherit;*/

            cursor:pointer;
        }
        .treeview li button, .treeview li button:active, .treeview li button:focus {
            text-decoration: none;
            color:inherit;
            border:none;
            background:transparent;
            margin:0px 0px 0px 0px;
            padding:0px 0px 0px 0px;
            outline: 0;
        }

        .orgChart{
            margin-bottom: 50px;
        }

        .img-orgChart {
            display: block;
            max-width: 50% !important;
            height: auto;
            float:left;
        }
        .popover{
            display: inline-block;
            /*white-space: nowrap;*/
            min-width: 500px;
            font-size: 1rem;
            box-shadow: 0 10px 20px rgba(0,0,0,0.19), 0 6px 6px rgba(0,0,0,0.23);
            border: 0;
            border-radius: 0;
        }
        .popover-body{
            padding: 0;
        }
        .popover-header{
            background-color: #EBC200;
            color: #002C48;
            border-bottom: 0px;
            padding-top: 0px;
            padding-bottom: 0px;
        }
    </style>
@endsection

