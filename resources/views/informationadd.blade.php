<x-app-layout>
    <x-slot name="slot">
        
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
               <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                    </li>
               </ul>
            <h1 class="m-0 text-dark">
             @if (isset($editData))
             Edit Information
             @else 
             Add Information
             @endif
            </h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Dashboard v2</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>

    <section class="col-md-12">
      <div class="card">
        <div class="card-header">
          <h3> Give Information</h3>
        </div>
         <div class="card-body">
            <form method="POST" action="{{(@$editData)?route('update.information', $editData->id): route('store.information') }}" enctype="multipart/form-data" >
              @csrf
              <div class="form-row">
                
                
                <div class="form-group col-md-5">
                  <lavel> Name</lavel>
                  <input type="text" name="name"  class="form-control" value="{{ (@$editData->name) }}" placeholder="First name">
                <font style="color: red">{{($errors->has('name'))?($errors->first('name')):''}}</font>
                </div>
                <div class="form-group col-md-5">
                  <lavel> Address</lavel>
                  <input name="address" type="text" class="form-control" value="{{ (@$editData->address) }}"  placeholder="Last name">
                </div>

                <div class="form-group col-md-4">
                  <lavel>Image</lavel>
                  <input type="file" name="image" class="form-control" id="image" placeholder="Last name">
                  <font style="color: red">{{($errors->has('image'))?($errors->first('image')):''}}</font>
                </div>

              <div class="form-grou col-md-4">
                <img src="{{ !empty($editData->image)?url('upload/' .$editData->image) : url('upload/no_image.png') }}" id="showImage"  style="width: 150px; height:160px; border:1px solid #000;">

              </div>

              </div>
              <button type="submit" class="btn btn-primary">{{ (@$editData)?'Update':'Submit' }}  </button>
            </form>
        </div>
      </div>

     


    </section>
    

   
  </div>
    </x-slot>

   
</x-app-layout>
