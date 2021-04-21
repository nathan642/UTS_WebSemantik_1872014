@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <form class="col-md-12" action="" method="get">
                      <div class="row">
                        <input type="text" id="searchtitle" name="search" class="form-control col-md-4" placeholder="Cari Judul Berita">
                        <button type="button" id="searchbutton" class="btn btn-danger">Cari</button>
                      </div>
                    </form>
                    <br>
                    <table class="table table-bordered">
                      <thead>
                        <tr>
                          <th>Sumber</th>
                          <th>Judul</th>
                          <th>Link</th>
                        </tr>
                      </thead>
                      <tbody id ="rss">
                      </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('ajaxjs')
<script type="text/javascript">
    $(document).ready(function(){
      getdata('')
    })


    $('#searchbutton').on('click',function(){
      getdata($('#searchtitle').val())
    })


    getdata = (search) =>{
      $('#rss').html('')
      $.ajax({
        type: 'GET',
        url: "{{ url('DataRSS') }}",
        data: {search: search},
        success: function(data) {

          for (var i=0;i<data.news.length;i++) {
            $('#rss')
            .append($('<tr>').append($('<td>').html(data.news[i].sourceweb))
            .append($('<td>').html(data.news[i].title)).append($('<td>').html('<a href="'+ data.news[i].link +'">'+ data.news[i].link +'</a>'))
            )
          }
        }
      })
    }
  </script>
@endsection