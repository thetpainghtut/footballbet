@extends('layouts.backendtemplate')
@section('title', 'Agents')
@section('content')
  <div class="container-fluid px-xl-5">
    <section class="py-5">
      <div class="row">
        <div class="col-lg-12 mb-4">
          <div class="card">
            <div class="card-header">
              <h6 class="text-uppercase mb-0 d-inline-block">Agent List</h6>
              <a href="#" class="btn btn-primary float-right">Add </a>
            </div>
            <div class="card-body">
              <table class="table table-bordered">
                <thead class="thead-dark">
                  <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Phone No</th>
                    <th>Points</th>
                    <th>Commission Rate</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <th scope="row">1</th>
                    <td>Mark</td>
                    <td>099876543</td>
                    <td>12,000</td>
                    <td>0.5</td>
                  </tr>
                  <tr>
                    <th scope="row">2</th>
                    <td>Jacob</td>
                    <td>098765432</td>
                    <td>32,000</td>
                    <td>1</td>
                  </tr>
                  <tr>
                    <th scope="row">3</th>
                    <td>Larry</td>
                    <td>0987654321</td>
                    <td>9,000</td>
                    <td>1.5</td>
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