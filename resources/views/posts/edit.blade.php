@extends('main')

@section('title', '| Edit Blog Post')

@section('stylesheets')
    {!! Html::style('css/select2.min.css') !!}

    <script src="https://cloud.tinymce.com/stable/tinymce.min.js"></script>

    <script>
        tinymce.init({
            selector: 'textarea',
            plugins: 'link code',
            menubar: false
        });
    </script>
@endsection

@section('content')

  <div class="row">
    {!! Form::model($post, ['route' => ['posts.update', $post->id], 'method' => 'PUT', 'files' => true]) !!}
    
    <div class="col-md-8">
        {{ Form::label('title', 'Title:') }}
        {{ Form::text('title', null, ['class' => 'form-control input-lg']) }}
        
        {{ Form::label('slug', 'Slug url:', ['class' => 'form-spacing-top']) }}
        {{ Form::text('slug', null, array('class' => 'form-control', 'required' => '', 'minlenght' => '5', 'maxlenght' => '255')) }}          
        
        {{ Form::label('category_id', 'Category:', ['class' => 'form-spacing-top']) }}
        {{ Form::select('category_id', $categories, null, ['class' => 'form-control']) }}
                        
        {{ Form::label('tags', 'Tags:', ['class' => 'form-spacing-top']) }}
        {{ Form::select('tags[]', $tags, null, ['class' => 'form-control select2-multi', 'multiple' => 'multiple']) }}
      
        {{ Form::label('featured_image', 'Update featured image:', ['class' => 'form-spacing-top']) }}
        {{ Form::file('featured_image') }}   
      
        {{ Form::label('body', 'Body:', ['class' => 'form-spacing-top']) }}
        {{ Form::textarea('body', null, ['class' => 'form-control']) }}
    </div>
    <div class="col-md-4">
        <div class="well">
            <dl class="dl-horizontal">
                <dt>Created at:</dt>
                <dd>{{ date('M j, Y H:i', strtotime($post->created_at)) }}</dd>
            </dl>
          
            <dl class="dl-horizontal">
                <dt>Last updated:</dt>
                <dd>{{  date('M j, Y H:i', strtotime($post->updated_at ))}}</dd>
            </dl>
            <hr>
            
            <div class="row">
                <div class="col-sm-6">
                    {!! Html::linkRoute('posts.show', 'Cancel', array($post->id), array('class' => 'btn btn-danger btn-block')) !!}
                </div>
                <div class="col-sm-6">
                    
                    {{ Form::submit('Save changes', array('class' => 'btn btn-success btn-block')) }}
                </div>
            </div>
          
        </div>
    </div>
    {!! Form::close() !!}
    
  </div> <!-- end of the form -->

@stop

@section('scripts')
    {!! Html::script('js/select2.min.js') !!}

    <script type="text/javascript">
      $('.select2-multi').select2();
      $('.select2-multi').select2().val({!! json_encode($post->tags()->getRelatedIds()) !!}).trigger('change');
    </script>
@endsection