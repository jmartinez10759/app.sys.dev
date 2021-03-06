@extends('layouts.template.app')
@section('content')
<!-- iCheck -->
<link rel="stylesheet" href="{{asset('admintle/plugins/iCheck/flat/blue.css')}}">

<style type="text/css">
    .list-group-item {
      z-index: 9999;
    }
    .list-group-item:hover{
      color: #337ab7;
      text-shadow:  0 0 1em #337ab7;
      cursor: pointer;
      z-index: 9999;
    }
    
  </style>
@push('styles')
<!-- Main content -->
<section class="content" ng-app="appication" ng-controller="CorreosController" ng-init="constructor()" ng-cloak>
  <div class="row">
    <div class="col-md-3">
      <a href="{{route('correos.recibidos')}}" class="btn btn-primary btn-block margin-bottom " >Regresar a Recibidos</a>

      <div class="box box-solid">
        <div class="box-header with-border">
          <h3 class="box-title">Folders</h3>

          <div class="box-tools">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
            </button>
          </div>
        </div>
           <div class="box-body no-padding">
            <ul class="nav nav-pills nav-stacked listado_correos">
              <li class="active">
                <a href="{{route('correos.recibidos')}}">
                  <i class="fa fa-inbox"></i> Recibidos
                  <span class="label label-success pull-right">@{{ datos.total_correos.correo }}</span>
                </a>
              </li>

              <li>
                <a href="{{route('correos.envios')}}">
                  <i class="fa fa-envelope-o"></i> Enviados
                  <span class="label label-primary pull-right">@{{ datos.total_correos.enviados }}</span>
                </a>
              </li>
              
              <li>
                <a href="{{route('destacados')}}">
                  <i class="fa fa-file-text-o"></i> Destacados
                  <span class="label label-info pull-right">@{{ datos.total_correos.destacados }}</span>
                </a>
              </li>
              
              <li>
                <a href="">
                  <i class="fa fa-align-justify"></i> Borradores
                  <span class="label label-warning pull-right">@{{ datos.total_correos.borradores }}</span>
                </a>
              </li>

              <li>
                <a href="{{route('papelera')}}">
                  <i class="fa fa-trash-o"></i> Papelera
                  <span class="label label-danger pull-right">@{{ datos.total_correos.papelera }}</span>
                </a>
              </li>
            
            </ul>
          </div>
        <!-- /.box-body -->
      </div>
      <!-- /. box -->
        <div class="box box-solid">
          <div class="box-header with-border">
            <h3 class="box-title">Categorias</h3>

            <div class="box-tools">
              <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
              </button>
            </div>
          </div>
          <div class="box-body no-padding">
            <ul class="nav nav-pills nav-stacked">
              <!-- <li><a href="#"><i class="fa fa-circle-o text-red"></i> Important</a></li>
              <li><a href="#"><i class="fa fa-circle-o text-yellow"></i> Promotions</a></li> -->
            </ul>
          </div>
          <!-- /.box-body -->
        </div>
        <!-- /.box -->

    </div>
    <!-- /.col -->
    <div class="col-md-9">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Redactar Nuevo Mensaje</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <div class="form-group">
            <input type="text" class="form-control" placeholder="Para:" ng-model="insert.emisor" ng-keyup="autocomplete(insert.emisor)" />
            <ul class="list-group" style="position: absolute;">
              <li class="list-group-item" ng-repeat="correos in filter track by $index" ng-click="fillTextbox(correos)">
                   @{{ correos }}
              </li>
            </ul>
          </div>
          <div class="form-group">
            <input type="text" class="form-control" placeholder="Asunto:" ng-model="insert.asunto">
          </div>
          <div class="form-group">
              <textarea class="form-control compose-textarea " style="height: 300px">
                  
              </textarea>

              <!-- <textarea class="form-control compose-textarea" style="height: 300px" ng-bind-html-unsafe="insert.descripcion">
              </textarea> -->
                  <!-- <h1><u>Heading Of Message</u></h1>
                  <h4>Subheading</h4>
                  <p>But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain
                    was born and I will give you a complete account of the system, and expound the actual teachings
                    of the great explorer of the truth, the master-builder of human happiness. No one rejects,
                    dislikes, or avoids pleasure itself, because it is pleasure, but because those who do not know
                    how to pursue pleasure rationally encounter consequences that are extremely painful. Nor again
                    is there anyone who loves or pursues or desires to obtain pain of itself, because it is pain,
                    but because occasionally circumstances occur in which toil and pain can procure him some great
                    pleasure. To take a trivial example, which of us ever undertakes laborious physical exercise,
                    except to obtain some advantage from it? But who has any right to find fault with a man who
                    chooses to enjoy a pleasure that has no annoying consequences, or one who avoids a pain that
                    produces no resultant pleasure? On the other hand, we denounce with righteous indignation and
                    dislike men who are so beguiled and demoralized by the charms of pleasure of the moment, so
                    blinded by desire, that they cannot foresee</p>
                  <ul>
                    <li>List item one</li>
                    <li>List item two</li>
                    <li>List item three</li>
                    <li>List item four</li>
                  </ul>
                  <p>Thank you,</p>
                  <p>John Doe</p> -->
          </div>
          <div class="form-group">
            <div class="btn btn-default btn-file" title="Subir Archivo">
              <i class="fa fa-paperclip"></i>
              <!-- <input type="file" multiple ng-upload-change> -->
              <input type="file" multiple ng-upload-change="readFile($event)" />
            </div>
              <li ng-repeat="file in files">@{{ file.name }}</li>
              <!-- <embed src="upload_file/archivos/manual.pdf" width="1000px" height="1000px"> -->
            <p class="help-block">Max. 32MB</p>
          </div>
        </div>
        <!-- /.box-body -->
        <div class="box-footer">
          <div class="pull-right">
            <div class="col-sm-6">
              <button type="button" class="btn btn-default">
                  <i class="fa fa-pencil"></i> Borrador
              </button>
              
            </div>
            <div class="col-sm-6">
              <button type="button" class="btn btn-primary" {{$email}}  ng-click="send_correo()">
                <i class="fa fa-envelope-o"></i> Enviar
              </button>
            </div>
          </div>
          <!-- <button type="reset" class="btn btn-default"><i class="fa fa-times"></i> Descartar</button> -->
        </div>
        <!-- /.box-footer -->
      </div>
      <!-- /. box -->
    </div>
    <!-- /.col -->
  </div>
  <!-- /.row -->
</section>
<!-- /.content -->
@stop
@push('scripts')
  <!-- iCheck -->
  <script src="{{asset('admintle/plugins/iCheck/icheck.min.js')}}"></script>

  <script type="text/javascript" src="{{asset('js/administracion/correos/build_correos.js')}}" ></script>
  <script type="text/javascript">
      jQuery(".compose-textarea").wysihtml5();
  </script>

@endpush
