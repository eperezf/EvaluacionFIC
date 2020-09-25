@extends('includes/template')
@section('title', 'Agenda y Noticias')


@section('extra_header')
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
@endsection


@section('contenido')
<h1>Agenda y Noticias</h1>

<!-- STYLE SECTION -->
<style type="text/css">
 
</style>
 
<div class="wrapper">

    <div class="header">
        <span class="glyphicon glyphicon-chevron-left"></span>
        <span class="glyphicon glyphicon-chevron-right"></span>
        <p>Septiembre 2020</p>
    </div><!-- end header -->

    <div class="calendar-body">
        <div class="row weekdays">
            <div class="col-xs-1"><p>Su</p></div><!-- end col-xs-1 -->
            <div class="col-xs-1"><p>Mo</p></div><!-- end col-xs-1 -->
            <div class="col-xs-1"><p>Tu</p></div><!-- end col-xs-1 -->
            <div class="col-xs-1"><p>We</p></div><!-- end col-xs-1 -->
            <div class="col-xs-1"><p>Th</p></div><!-- end col-xs-1 -->
            <div class="col-xs-1"><p>Fr</p></div><!-- end col-xs-1 -->
            <div class="col-xs-1"><p>Sa</p></div><!-- end col-xs-1 -->
        </div><!-- end row -->

        <div class="row dates">
            <div class="col-xs-1"><a href="#"><p class="inactive">28</p></a></div>
            <div class="col-xs-1"><a href="#"><p class="inactive">29</p></a></div>
            <div class="col-xs-1"><a href="#"><p class="inactive">30</p></a></div>
            <div class="col-xs-1"><a href="#"><p class="inactive">31</p></a></div>
            <div class="col-xs-1"><a href="#"><p>1</p></a></div>
            <div class="col-xs-1"><a href="#"><p>2</p></a></div>
            <div class="col-xs-1"><a href="#"><p>3</p></a></div>
        </div><!-- end row -->

        <div class="row dates">
            <div class="col-xs-1"><a href="#"><p>4</p></a></div>
            <div class="col-xs-1"><a href="#"><p>5</p></a></div>
            <div class="col-xs-1"><a href="#"><p>6</p></a></div>
            <div class="col-xs-1"><a href="#"><p>7</p></a></div>
            <div class="col-xs-1"><a href="#"><p>8</p></a></div>
            <div class="col-xs-1"><a href="#"><p>9</p></a></div>
            <div class="col-xs-1"><a href="#"><p>10</p></a></div>
        </div><!-- end row -->

        <div class="row dates">
            <div class="col-xs-1"><a href="#"><p>11</p></a></div>
            <div class="col-xs-1"><a href="#"><p>12</p></a></div>
            <div class="col-xs-1"><a href="#"><p>13</p></a></div>
            <div class="col-xs-1"><a href="#"><p>14</p></a></div>
            <div class="col-xs-1"><a href="#"><p>15</p></a></div>
            <div class="col-xs-1"><a href="#"><p>16</p></a></div>
            <div class="col-xs-1"><a href="#"><p>17</p></a></div>
        </div><!-- end row -->

        <div class="row dates">
            <div class="col-xs-1"><a href="#"><p>18</p></a></div>
            <div class="col-xs-1"><a href="#"><p>19</p></a></div>
            <div class="col-xs-1"><a href="#"><p>20</p></a></div>
            <div class="col-xs-1"><a href="#"><p>21</p></a></div>
            <div class="col-xs-1"><a href="#"><p>22</p></a></div>
            <div class="col-xs-1"><a href="#"><p>23</p></a></div>
            <div class="col-xs-1"><a href="#"><p>24</p></a></div>
        </div><!-- end row --> 

        <div class="row dates">
            <div class="col-xs-1"><a href="#"><p>25</p></a></div>
            <div class="col-xs-1"><a href="#"><p>26</p></a></div>
            <div class="col-xs-1"><a href="#"><p>27</p></a></div>
            <div class="col-xs-1"><a href="#"><p>28</p></a></div>
            <div class="col-xs-1"><a href="#"><p>29</p></a></div>
            <div class="col-xs-1"><a href="#"><p>30</p></a></div>
            <div class="col-xs-1"><a href="#"><p>31</p></a></div>
        </div><!-- end row -->

        <div class="line"></div>
        <div class="current-date">Jueves, Septiembre 24</div>

    </div><!-- end calendar-body -->
</div><!-- end wrapper -->

@endsection
