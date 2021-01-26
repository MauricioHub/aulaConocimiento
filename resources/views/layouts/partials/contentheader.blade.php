<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        @yield('contentheader_title', 'Page Header here')
        <small>@yield('contentheader_description')</small>
    </h1>
    <ol class="breadcrumb">
         <li><a href="{{ URL::previous() }}"><i class="fa fa-dashboard"></i> Atrás</a></li>
        <li class="active">{{ trans('adminlte_lang::message.here') }}</li> 
    </ol>
</section>