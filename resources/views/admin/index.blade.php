@extends('layouts.admin')

@section('content')
 <section id="container" >  
      <!--sidebar start--> 
      <aside>
          <div id="sidebar"  class="nav-collapse ">
              <!-- sidebar menu start-->
              <ul class="sidebar-menu" id="nav-accordion">
                  <h5 class="centered">Admin name</h5>
                  
                  <li class="sub-menu">
                      <a href="#" >
                          <i class="glyphicon glyphicon-envelope"></i>
                          <span>Mails</span>
                      </a>
                  </li>
                  <li class="sub-menu">
                      <a href="{{route('chat')}}" >
                          <i class="glyphicon glyphicon-inbox"></i>
                          <span>Chats</span>
                      </a>
                  </li>

                  <li class="sub-menu">
                      <a href="{{route('manage.sellers') }}" >
                          <i class="fa fa-desktop"></i>
                          <span>Sellers</span>
                      </a>
                  </li>

                  <li class="sub-menu">
                      <a href="{{route('manage.buyers')}}" >
                          <i class="fa fa-cogs"></i>
                          <span>Buyers</span>
                      </a>
                  </li>
                  <li class="sub-menu">
                      <a href="{{route('manage.products') }}" >
                          <i class="fa fa-book"></i>
                          <span>Products</span>
                      </a>
                  </li>

              </ul>
              <!-- sidebar menu end-->
          </div>
      </aside>
      <!--sidebar end-->                  
  </section>

@endsection