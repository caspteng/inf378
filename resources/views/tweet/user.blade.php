@extends('layouts.auth')
@section('content')


<h1>Liste des tweet</h1>
@foreach($tweets as $singleTweet) 


<table class="ui celled padded table">
    <thead>
        <tr>
            <th>Message</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>
            
                {{ $singleTweet->message }}    
               
               <div class="right aligned"> {{ $singleTweet->user['username'] }} </div> 
     
            
            </td>
        </tr>
    </tbody>

</table>

@endforeach
@stop
