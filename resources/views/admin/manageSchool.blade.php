@extends('layouts.admin')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-3">
           
                <a style="background-color:brown;color:white;border-radius:5px;font-size:18px;padding:15px;margin-top:15px" href="{{ url('admin/addSchool') }}">Add School</a>
              
                <table class="table" style="margin-top:25px">
                  <thead style="background-color:brown">
                    <tr>
                      <th style="padding:15px;color:white;text-align:center;font-size:16px;border:1px solid grey">S.No</th>
                      <th style="padding:15px;color:white;text-align:center;font-size:16px;border:1px solid grey">School Name</th>
                      <th style="padding:15px;color:white;text-align:center;font-size:16px;border:1px solid grey">Edit</th>
                      <th style="padding:15px;color:white;text-align:center;font-size:16px;border:1px solid grey">Delete</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php $i=1; ?>  
                      @foreach($schools as $school)
                        <tr style="background-color:#f3f4c6">

                          <td style="padding:15px;text-align:center;border:1px solid grey;">{{ $i++ }}</td>
                          <td style="padding:15px;text-align:center;border:1px solid grey;">{{ $school['name'] }}</td>
                          <td style="padding:15px;text-align:center;border:1px solid grey;"><a href="/admin/schoolEdit/{{ $school['id'] }}" ><i class="fa fa-edit fa-lg" style="text-align:cenetr;"></i></a></td>
                          <td style="padding:15px;text-align:center;border:1px solid grey;"><a href="/admin/schoolDelete/{{ $school['id'] }}" ><i class="fa fa-trash fa-lg" style="text-align:cenetr;"></i></a></td>

                        </tr>
                      @endforeach
                  </tbody> 
                </table>
              </div>
            </div>
      </div>
@endsection
