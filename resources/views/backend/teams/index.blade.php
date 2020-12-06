@extends('layouts.backendtemplate')
@section('title', 'Teams')
@section('content')
  <div class="container-fluid px-xl-5">
    <section class="py-5">
      <div class="row">
        <div class="col-lg-12 mb-4">
          <div class="card">
            <div class="card-header">
              <h6 class="text-uppercase mb-0 d-inline-block">Team List</h6>
              <a href="#" class="btn btn-primary float-right">Add </a>
            </div>
            <div class="card-body">
              <table class="table table-bordered">
                <thead class="thead-dark">
                  <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Leagues</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <th scope="row" class="align-middle">1</th>
                    <td class="align-middle">Man U</td>
                    <td>
                      <span class="badge badge-info p-2 badge-pill">Premere Leagues</span>
                      <span class="badge badge-info p-2 badge-pill">Euopa Leagues</span>
                      <span class="badge badge-info p-2 badge-pill">Champion Leagues</span>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
@endsection