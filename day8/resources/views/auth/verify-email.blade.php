<x-layout>

<h1 class = "mb-4">Please verify your email address</h1>

<p class = "mb-4">Before continuing, could you verify your email address by clicking on the link we just emailed to you? If you didn't receive the link, we will gladly send you another.</p>



<form action="{{ route('verification.send') }}" method=""post>

    @csrf
    <button class="btn">Send Again</button>

</form>

