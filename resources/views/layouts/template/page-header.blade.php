<header class="main-header">
        <!-- Logo -->
        <a href="{{$url_previus}}" class="logo" title="Regresar a Listado de Empresas">
          <!-- mini logo for sidebar mini 50x50 pixels -->
          <span class="logo-mini">{{$empresa}}</span>
          <!-- logo for regular state and mobile devices -->
          <span class="logo-lg">{{$empresa}}</span>
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
            <span class="sr-only">Toggle navigation</span>
          </a>

          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
              <!-- Messages: style can be found in dropdown.less-->
              <li class="dropdown messages-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <i class="fa fa-envelope-o"></i>
                  <span class="label label-primary notify" ng-if="correos.length > 0">.</span>
                  <span class="label label-success " ng-bind="correos.length "></span>
                </a>
                <ul class="dropdown-menu">
                  <li class="header">Tu Tienes @{{ correos.length }} Mensajes </li>
                  <li>
                    <!-- inner menu: contains the actual data -->
                    <ul class="menu">
                        <li ng-repeat="correos in correos"><!-- start message -->
                          <a style="cursor:pointer;">
                            <div class="pull-left">
                              <img src="{{asset('img/profile/profile.png')}}" class="img-circle" alt="User Image">
                            </div>
                            <h6>
                              @{{ correos.asunto }}
                              <small>
                                <p class="pull-right">
                                  <i class="fa fa-clock-o"></i> 
                                  @{{time_fechas(correos.created_at)}}
                                </p>
                              </small>
                            </h6>
                            <p>@{{correos.correo}}</p>
                          </a>
                        </li>
                      <!-- end message -->
                    </ul>
                  </li>
                  <!-- <li class="footer"><a href="#">See All Messages</a></li> -->
                </ul>
              </li>
              {{--<div ng-if="notificaciones.length > 0">
                <audio autoplay loop>
                  <source src="audio/messenger-tono-mensaje-.mp3">
                </audio>
              </div>--}}
              <!-- Notifications: style can be found in dropdown.less -->
              <li class="dropdown notifications-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <i class="fa fa-bell-o"></i>
                  <span class="label label-primary notify" ng-if="notificaciones.length > 0">.</span>
                  <span class="label label-primary " ng-if="notificaciones.length == 0">.</span>
                  <span class="label label-warning" ng-bind="notificaciones.length"></span>
                </a>
                <ul class="dropdown-menu">
                  <li class="header" ng-if="notificaciones.length > 0">Tu Tienes @{{ notificaciones.length }} Notificaciones</li>
                  <li class="header" ng-if="notificaciones.length == 0">Tu Tienes 0 Notificaciones</li>

                  <li>
                    <!-- inner menu: contains the actual data -->
                    <ul class="menu">

                      <li ng-repeat="notify in notificaciones ">
                          <a ng-click="notifyDetails(notify)" style="cursor:pointer;">
                            <h6>
                              <i class="fa fa-bell-o text-blue" ng-bind="notify.title"></i>
                            </h6>
                            <small><p ng-bind="notify.message"></p></small>
                            <small class="pull-right"><i class="fa fa-clock-o" ng-bind="timeDate(notify.created_at)"></i></small>
                          </a>
                        </li>

                    </ul>
                  </li>
                  <li class="footer"></li>
                </ul>
              </li>
              <!-- Tasks: style can be found in dropdown.less -->
              <li class="dropdown tasks-menu" style="display:none;">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <i class="fa fa-flag-o"></i>
                  <span class="label label-danger">9</span>
                </a>
                <ul class="dropdown-menu">
                  <li class="header">You have 9 tasks</li>
                  <li>
                    <!-- inner menu: contains the actual data -->
                    <ul class="menu">
                      <li><!-- Task item -->
                        <a href="#">
                          <h3>
                            Design some buttons
                            <small class="pull-right">20%</small>
                          </h3>
                          <div class="progress xs">
                            <div class="progress-bar progress-bar-aqua" style="width: 20%" role="progressbar"
                                 aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                              <span class="sr-only">20% Complete</span>
                            </div>
                          </div>
                        </a>
                      </li>
                      <!-- end task item -->
                      <li><!-- Task item -->
                        <a href="#">
                          <h3>
                            Create a nice theme
                            <small class="pull-right">40%</small>
                          </h3>
                          <div class="progress xs">
                            <div class="progress-bar progress-bar-green" style="width: 40%" role="progressbar"
                                 aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                              <span class="sr-only">40% Complete</span>
                            </div>
                          </div>
                        </a>
                      </li>
                      <!-- end task item -->
                      <li><!-- Task item -->
                        <a href="#">
                          <h3>
                            Some task I need to do
                            <small class="pull-right">60%</small>
                          </h3>
                          <div class="progress xs">
                            <div class="progress-bar progress-bar-red" style="width: 60%" role="progressbar"
                                 aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                              <span class="sr-only">60% Complete</span>
                            </div>
                          </div>
                        </a>
                      </li>
                      <!-- end task item -->
                      <li><!-- Task item -->
                        <a href="#">
                          <h3>
                            Make beautiful transitions
                            <small class="pull-right">80%</small>
                          </h3>
                          <div class="progress xs">
                            <div class="progress-bar progress-bar-yellow" style="width: 80%" role="progressbar"
                                 aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                              <span class="sr-only">80% Complete</span>
                            </div>
                          </div>
                        </a>
                      </li>
                      <!-- end task item -->
                    </ul>
                  </li>
                  <li class="footer">
                    <a href="#">View all tasks</a>
                  </li>
                </ul>
              </li>
              <!-- User Account: style can be found in dropdown.less -->
              <li class="dropdown user user-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <img src="{{ $photo_profile }}" class="user-image" alt="User Image">
                  <span class="hidden-xs">{{ $nombre_completo }}</span>
                </a>
                <ul class="dropdown-menu">
                  <!-- User image -->
                  <li class="user-header">
                    <img src="{{ $photo_profile }}" class="img-circle" alt="User Image">

                    <p>
                      {{ $nombre_completo }}
                      <small>{{$rol}}</small>
                      <!-- <small>{{$empresa}}</small> -->
                      <small>{{$sucursal}}</small>
                    </p>
                  </li>
                  <!-- Menu Body -->
                  <li class="user-body">
                    <!-- <div class="row">
                      <div class="col-xs-4 text-center">
                        <a href="#">Followers</a>
                      </div>
                      <div class="col-xs-4 text-center">
                        <a href="#">Sales</a>
                      </div>
                      <div class="col-xs-4 text-center">
                        <a href="#">Friends</a>
                      </div>
                    </div> -->
                    <!-- /.row -->
                  </li>
                  <!-- Menu Footer-->
                  <li class="user-footer">
                    <div class="row">
                      <div class="col-sm-6">
                        <a href="{{ route('perfiles')}} " class="btn btn-default btn-flat">
                          <i class="fa fa-user pull-left"></i>Perfil Usuario
                        </a>
                      </div>

                      <div class="col-sm-6">
                        <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="btn btn-default btn-flat">
                          <i class="fa fa-sign-out pull-left"></i>Cerrar Sesión
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;"> {{ csrf_field() }} </form>

                      </div>

                    </div>
                  </li>
                </ul>
              </li>
              <!-- Control Sidebar Toggle Button -->
              <li>
                <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
              </li>
            </ul>
          </div>
        </nav>

</header>
