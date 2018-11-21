@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Chats</div>
                <div class="card-body">
                  <chat-component>
                      <messages-component :messages="message">
                      </messages-component>
                      <chat-form-component v-on :messageCreated="addMessage" ></chat-form-component>
                  </chat-component>
                </div>
            </div>
        </div>

        @if(Auth::user()->role->name !== 'buyer' && Auth::user()->role->name !== 'seller')))
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">Users</div>
                    <div class="card-body">
                        <user-component></user-component>
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>
@endsection