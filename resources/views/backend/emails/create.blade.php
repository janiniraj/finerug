@extends ('backend.layouts.app')

@section ('title', trans('labels.backend.emails.management') . ' | ' . trans('labels.backend.emails.create'))

@section('page-header')
    <h1>
        {{ trans('labels.backend.emails.management') }}
        <small>{{ trans('labels.backend.emails.create') }}</small>
    </h1>
@endsection

@section('content')
    {{ Form::open(['route' => 'admin.emails.store', 'class' => 'form-horizontal', 'role' => 'form', 'method' => 'post', 'id' => 'create-permission', 'files' => true,'novalidate']) }}

        <div class="box box-success">
            <div class="box-header with-border">
                <h3 class="box-title">{{ trans('labels.backend.emails.create') }}</h3>

                <div class="box-tools pull-right">
                    @include('backend.includes.partials.emails-header-buttons')
                </div><!--box-tools pull-right-->
            </div><!-- /.box-header -->

            {{-- Including Form blade file --}}
            <div class="box-body">
                    @include("backend.emails.form")
                    <div class="edit-form-btn pull-right">
                    {{ link_to_route('admin.emails.index', trans('buttons.general.cancel'), [], ['class' => 'btn btn-danger btn-md']) }}
                    {{ Form::submit(trans('buttons.general.crud.create'), ['class' => 'btn btn-primary btn-md']) }}
                    <div class="clearfix"></div>
                </div>
        </div><!--box-->
    </div>
    {{ Form::close() }}
@endsection
@section('after-scripts')
<script>
   var route_prefix = "{{ url(config('lfm.url_prefix', config('lfm.prefix'))) }}";
</script>
<script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
  <script>
    var editor_config = {
      path_absolute : "",
      selector: "textarea[name=content]",
      plugins: [
        "advlist autolink lists link image charmap print preview hr anchor pagebreak",
      "searchreplace wordcount visualblocks visualchars code fullscreen",
      "insertdatetime media nonbreaking save table contextmenu directionality",
      "emoticons template paste textcolor colorpicker textpattern"
      ],
      relative_urls: false,
      height: 129,
      toolbar: [
                "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media | code"],
      file_browser_callback : function(field_name, url, type, win) {
        var x = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName('body')[0].clientWidth;
        var y = window.innerHeight|| document.documentElement.clientHeight|| document.getElementsByTagName('body')[0].clientHeight;

        var cmsURL = editor_config.path_absolute + route_prefix + '?field_name=' + field_name;
        if (type == 'image') {
          cmsURL = cmsURL + "&type=Images";
        } else {
          cmsURL = cmsURL + "&type=Files";
        }

        tinyMCE.activeEditor.windowManager.open({
          file : cmsURL,
          title : 'Filemanager',
          width : x * 0.8,
          height : y * 0.8,
          resizable : "yes",
          close_previous : "no"
        });
      }
    };

    tinymce.init(editor_config);
    $(document).ready(function(){
        $(".user-container").hide();
        $(".mailinglist-container").hide();
        $("#type_users").on('change', function(){
            if($(this).val() == 'specific_user')
            {
                $(".user-container").show();
                $(".mailinglist-container").hide();
            }
            else if($(this).val() == 'specific__mailing_list')
            {
                $(".user-container").hide();
                $(".mailinglist-container").show();
            }
            else
            {
                $(".user-container").hide();
                $(".mailinglist-container").hide(); 
            }
        });
    });
  </script>
@endsection