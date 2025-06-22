@extends('layouts.master')

@section('title', 'Landing Page')

@push('styles')
<style>
    .banner {
        background-color: #009cdb;
        padding: 80px 20px;
        text-align: center;
        color: white;
    }

    .banner h1 {
        font-size: 36px;
        margin-bottom: 10px;
    }

    .banner p {
        font-size: 20px;
    }

    .btn {
        display: inline-block;
        margin-top: 20px;
        padding: 12px 30px;
        background-color: #3490dc;
        color: #fff;
        text-decoration: none;
        border-radius: 5px;
        font-size: 18px;
    }

    .btn:hover {
        background-color: #2779bd;
    }

    .section-title {
        font-size: 28px;
        text-align: center;
        margin: 20px 0;
    }

    .carousel {
        display: flex;
        justify-content: space-between;
        overflow-x: auto;
        padding: 20px;
        gap: 20px;
        margin-bottom: 40px;
    }

    .card {
        background-color: #ffffff;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        width: 280px;
        flex-shrink: 0;
    }

    .card img {
        width: 100%;
        height: auto;
        border-radius: 8px;
    }

    .card p {
        margin-top: 10px;
        font-size: 16px;
        font-weight: bold;
    }

    .carousel-nav {
        display: flex;
        justify-content: center;
        gap: 10px;
    }

    .carousel-nav span {
        font-size: 30px;
        cursor: pointer;
        color: #3490dc;
    }

    .carousel-nav span:hover {
        color: #2779bd;
    }
</style>
@endpush

@section('content')
    <!-- Banner Section -->
    <div class="banner">
        <h1>ini adalah home</h1>
        <p>Pengelolaan & Pengembangan Sumber Daya Manusia</p>
    </div>
