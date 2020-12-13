@extends('layouts.backendtemplate')
@section('title', 'Matches')
@section('content')
  <div class="container-fluid px-xl-5">
    <section class="py-5">
      <div class="row">
        <div class="col-lg-12 mb-4">
          <div class="card">
            <div class="card-header">
              <h6 class="text-uppercase mb-0 d-inline-block">Match List Today</h6>
              <a href="#" class="btn btn-primary float-right">Add </a>
            </div>
            <div class="card-body">
              <table class="table table-bordered">
                <thead class="thead-dark">
                  <tr>
                    <th>#</th>
                    <th>Time</th>
                    <th>Event</th>
                    <th>Home</th>
                    <th>Away</th>
                    <th>Over</th>
                    <th>Under</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <th scope="row">1</th>
                    <td>Mark</td>
                    <td>099876543</td>
                    <td>Mark</td>
                    <td>099876543</td>
                    <td>Mark</td>
                    <td>099876543</td>
                    <td><a href="#" class="btn btn-info" data-toggle="modal" data-target="#exampleModal">Change Bet</a></td>
                  </tr>
                  <tr>
                    <th scope="row">2</th>
                    <td>Jacob</td>
                    <td>098765432</td>
                    <td>Mark</td>
                    <td>099876543</td>
                    <td>Mark</td>
                    <td>099876543</td>
                    <td><a href="#" class="btn btn-info">Change Bet</a></td>
                  </tr>
                  <tr>
                    <th scope="row">3</th>
                    <td>Larry</td>
                    <td>0987654321</td>
                    <td>Mark</td>
                    <td>099876543</td>
                    <td>Mark</td>
                    <td>099876543</td>
                    <td><a href="#" class="btn btn-info">Change Bet</a></td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>

  <!-- Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Changing Bet Rate</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="form-row">
            <div class="form-group col-md-6">
              <label for="inputHome">Home</label>
              <input type="number" class="form-control" id="inputHome">
            </div>
            <div class="form-group col-md-6">
              <label for="inputAway">Away</label>
              <input type="number" class="form-control" id="inputAway">
            </div>
          </div>
          <div class="form-row">
            <div class="form-group col-md-6">
              <label for="inputOver">Over</label>
              <input type="number" class="form-control" id="inputOver">
            </div>
            <div class="form-group col-md-6">
              <label for="inputUnder">Under</label>
              <input type="number" class="form-control" id="inputUnder">
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary">Save changes</button>
        </div>
      </div>
    </div>
  </div>
@endsection