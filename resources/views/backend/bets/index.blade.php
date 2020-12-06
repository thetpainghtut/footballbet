@extends('layouts.backendtemplate')
@section('title', 'Bets')
@section('content')
  <div class="container-fluid px-xl-5">
    <section class="py-5">
      <div class="row">
        <div class="col-lg-12 mb-4">
          <div class="card">
            <div class="card-header">
              <h6 class="text-uppercase mb-0 d-inline-block">Bet List</h6>
              <span class="float-right">Dec 06, 2020</span>
            </div>
            <div class="card-body">
              <form method="" action="" class="mb-4">
                <div class="form-row">
                  <div class="col">
                    <input type="date" class="form-control" placeholder="Start Date">
                  </div>
                  <div class="col">
                    <input type="date" class="form-control" placeholder="End Date">
                  </div>
                  <div class="col">
                    <input type="submit" name="btn-submit" class="btn btn-info" value="Search">
                  </div>
                </div>
              </form>
              <table class="table table-bordered">
                <thead class="thead-dark">
                  <tr>
                    <th scope="col">No</th>
                    <th scope="col">Agent</th>
                    <th scope="col">Soccer</th>
                    <th scope="col">Type</th>
                    <th scope="col">Rate</th>
                    <th scope="col">Amount</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <th scope="row">#</th>
                    <td class="align-middle">Mg Mg</td>
                    <td class="align-middle">Team One vs Team Two</td>
                    <td class="align-middle">AWAY</td>
                    <td class="align-middle">0.95</td>
                    <td class="align-middle">{{number_format(2000)}}</td>
                  </tr>
                  <tr>
                    <th scope="row">#</th>
                    <td class="align-middle">Mg Mg</td>
                    <td class="align-middle">Team One vs Team Two</td>
                    <td class="align-middle">AWAY</td>
                    <td class="align-middle">0.95</td>
                    <td class="align-middle">{{number_format(2000)}}</td>
                  </tr>
                  <tr>
                    <th scope="row">#</th>
                    <td class="align-middle">Mg Mg</td>
                    <td class="align-middle">Team One vs Team Two</td>
                    <td class="align-middle">AWAY</td>
                    <td class="align-middle">0.95</td>
                    <td class="align-middle">{{number_format(2000)}}</td>
                  </tr>
                  <tr>
                    <th scope="row">#</th>
                    <td class="align-middle">Mg Mg</td>
                    <td class="align-middle">Team One vs Team Two</td>
                    <td class="align-middle">AWAY</td>
                    <td class="align-middle">0.95</td>
                    <td class="align-middle">{{number_format(2000)}}</td>
                  </tr>
                  <tr>
                    <th scope="row">#</th>
                    <td class="align-middle">Mg Mg</td>
                    <td class="align-middle">Team One vs Team Two</td>
                    <td class="align-middle">AWAY</td>
                    <td class="align-middle">0.95</td>
                    <td class="align-middle">{{number_format(2000)}}</td>
                  </tr>
                  <tr>
                    <th scope="row">#</th>
                    <td class="align-middle">Mg Mg</td>
                    <td class="align-middle">Team One vs Team Two</td>
                    <td class="align-middle">AWAY</td>
                    <td class="align-middle">0.95</td>
                    <td class="align-middle">{{number_format(2000)}}</td>
                  </tr>
                  <tr>
                    <th scope="row">#</th>
                    <td class="align-middle">Mg Mg</td>
                    <td class="align-middle">Team One vs Team Two</td>
                    <td class="align-middle">AWAY</td>
                    <td class="align-middle">0.95</td>
                    <td class="align-middle">{{number_format(2000)}}</td>
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