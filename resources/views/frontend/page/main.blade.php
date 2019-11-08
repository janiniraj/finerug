@extends('frontend.layouts.master')

@section('after-styles')
	@if(isset($styleName) && $styleName)
		{{ Html::style('/frontend/css/'.$styleName) }}
	@endif    
@endsection

@section('content')
    @if(isset($content))
        {!! $content !!}
    @else
    	{!! $pageData->content !!}
    @endif
@endsection