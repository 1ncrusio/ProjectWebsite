@extends('layouts.master')
@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Cari Perangkat</h1>
            </div>
            <div class="section-body">
                <div class="row">
                    <div class="col-lg-4">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <i class="fa fa-user fa-fw"></i> Pencarian
                            </div>

                            <!-- /.panel-heading -->
                            <div class="panel-body">
                                <fieldset>
                                    <div class="form-group">
                                        <label>Code Alat</label>
                                        <input name="search" type="text" id="search" class="form-control"
                                            placeholder="Masukan code">
                                    </div>
                                </fieldset>
                                <button id="searchButton" class="btn btn-primary">Cari</button>
                            </div>
                            <!-- /.panel-body -->
                        </div>
                    </div>
                    <div class="col-lg-8">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <i class="fa fa-user fa-fw"></i>Data Alat
                            </div>
                            <div class="panel-body">
                                <div class="panel-body">
                                    <div class="table-responsive">
                                        <table id="data-table" class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th scope="col">#</th>
                                                    <th scope="col">Code</th>
                                                    <th scope="col">Lantai</th>
                                                    <th scope="col">Ruangan</th>
                                                </tr>
                                            </thead>
                                            <?php $no = 1; ?>
                                                @foreach ($alat as $item)
                                                    <tr>
                                                        <td>{{ $no++ }}</td>
                                                        <td>{{ $item->code }}</td>
                                                        <td>{{ $item->lt }}</td> 
                                                        <td>{{ $item->ruangan }}</td>
                                                        <!-- <td>
                                                        <form action="{{ url('status', $item->code) }}" method="post">
                                                                @csrf
                                                                @if ($item->status == 'offline')
                                                                    <input type="hidden" name="online" value="online">
                                                                    <button class="btn " type="submit"><i
                                                                            class="fa fa-check"
                                                                            style="color: blue;"></i></button>
                                                                @else($item->status == 'online')
                                                                    <button class="btn " type="submit"
                                                                        style="color: green;">Selesai</button>        
                                                                        @endif
                                                            </form>
                                                        </td> -->
                                                    </tr>
                                                @endforeach
                                            </tbody>

                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $("#searchButton").click(function() {
                var value = $("#search").val().toLowerCase();
                $("#data-table tbody tr").filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
                });
            });
        });
    </script>
@endsection
