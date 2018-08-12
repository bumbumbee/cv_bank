@extends('layouts.app')

@section('content')
 <div class="container create-edit">
     <h2>Upload your CV</h2>
     <form action="/cv_task/public/" method="POST" enctype="multipart/form-data">
         {{ csrf_field() }}
         <input type="text" placeholder="Name" name="name" id="name">
         <input type="email" placeholder="Email" name="email" id="email">

         <div class="form-group">
             <label for="category">Choose your category:</label>
             <select name="category" id="category">
                 <option value=""></option>
                 <option value="Frontend developer">Frontend developer</option>
                 <option value="Backend developer">Backend developer</option>
                 <option value="Full Stack developer">Full Stack developer</option>
             </select>
         </div>

         <div class="form-group">
             <label for="file" class="file-input">Attach file</label>
             <input type="file" name="file" id="file" class="file-input">
         </div>

         <button type="submit" class="btn btn-success">Create Post</button>
     </form>
 </div>

@endsection