@extends('layouts.master')
@section('title', 'Beranda')
@section('content')

<style>
    body {
        margin: 0;
        padding: 0;
        background-color: #f0f4f8;
    }

    .hero-section {
        background: linear-gradient(to bottom, #82d7e9, #2f5862);
        padding: 100px 80px 150px 80px;
        color: #000;
        display: flex;
        justify-content: space-between;
        align-items: center;
        position: relative;
    }

    .hero-left {
        max-width: 50%;
    }

    .hero-left h1 {
        font-size: 48px;
        font-weight: bold;
        margin-bottom: 10px;
    }

    .hero-left h1 span {
        color: #000042;
        font-weight: 900;
        font-style: italic;
    }

    .hero-left h4 {
        font-weight: bold;
        margin-top: 20px;
    }

    .hero-left p {
        margin-top: 10px;
        line-height: 1.6;
    }

    .hero-right img {
        width: 350px;
        height: 350px;
        object-fit: cover;
        border-radius: 50%;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
    }

    .curve {
        position: absolute;
        bottom: 0;
        left: 0;
        width: 100%;
        overflow: hidden;
        line-height: 0;
        transform: translateY(1px);
    }

    .curve svg {
        position: relative;
        display: block;
        width: calc(100% + 1.3px);
        height: 120px;
    }

    .curve .shape-fill {
        fill: #ffffff;
        filter: drop-shadow(0px -4px 6px rgba(0, 0, 0, 0.3));
    }

    .section-title {
        text-align: center;
        font-size: 42px;
        font-style: italic;
        font-weight: bold;
        margin-top: 60px;
        text-decoration: underline;
        color: #000;
    }

    .card-section {
        display: flex;
        justify-content: center;
        gap: 30px;
        flex-wrap: wrap;
        margin: 30px auto 60px auto;
        padding: 0 5vw;
    }

    .card {
        flex: 0 0 300px;
        background-color: #d0eff9;
        border-radius: 20px;
        box-shadow: 0 3px 6px rgba(0, 0, 0, 0.1);
        padding: 20px;
    }

    .card h4 {
        color: #003355;
        margin-bottom: 10px;
    }

    .card p {
        font-size: 14px;
        color: #000;
    }

    .card a {
        display: block;
        margin-top: 10px;
        font-style: italic;
        color: #000;
        text-decoration: none;
    }
</style>


@endsection
