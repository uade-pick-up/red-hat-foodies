@extends("admin/layouts.master")
@section('title','Add New Coupon')

@section('body')

<section class="content">
  <div class="row">
    <div class="col-md-8">
    <div class="box box-primary">
    
    <div class="box-header with-border">
      <div class="box-title">
          Create New Coupon
      </div>
    </div>
    <form action="{{ route('coupon.store') }}" method="POST">
    @csrf
      <div class="box-body">
           
          <div class="form-group">
            <label>Coupon code: <span class="redstar">*</span></label>
            <input required="" type="text" class="form-control" name="code">
          </div>
          <div class="form-group">
            <label>Discount type: <span class="redstar">*</span></label>
            
              <select required="" name="distype" id="distype" class="form-control">
                
                <option value="fix">Fix Amount</option>
                <option value="per">% Percentage</option>
                
              </select>
            
          </div>
          <div class="form-group">
              <label>Amount: <span class="redstar">*</span></label>
              <input required="" type="text"  class="form-control" name="amount">
            
          </div>
          <div class="form-group">
            <label>Linked to: <span class="redstar">*</span></label>
            
              <select required="" name="link_by" id="link_by" class="form-control js-example-basic-single">
                <option value="none" selected disabled hidden> 
                  Select an Option 
                </option>
                <option value="course">Link By Course</option>
                <option value="cart">Link to Cart</option>
                <option value="category">Link to Categories</option>
              </select>
            
          </div>

          
          <div id="probox" class="form-group display-none">
            <label>Select Course: <span class="redstar">*</span> </label>
            <br>
            <select id="pro_id" name="course_id" class="js-example-basic-single form-control">
                <option value="none" selected disabled hidden> 
                  Select an Option 
                </option>
                @foreach(App\Course::where('status','1')->get() as $product)
                  @if($product->type == 1)
                    <option value="{{ $product->id }}">{{ $product['title'] }}</option>
                  @endif
                @endforeach
            </select>
          </div>
       

          <div id="catbox" class="form-group display-none">
            <label>Select Categories: <span class="required">*</span> </label>
            <br>
            <select id="cat_id" name="category_id" class="js-example-basic-single form-control">
                <option value="none" selected disabled hidden> 
                  Select an Option 
                </option>
                @foreach(App\Categories::where('status','1')->get() as $category)
                  <option value="{{ $category->id }}">{{ $category['title'] }}</option>
                @endforeach
            </select>
          </div>

          <div class="form-group">
            <label>Max Usage Limit: <span class="redstar">*</span></label>
            <input required="" type="number" min="1" class="form-control" name="maxusage">
          </div>
          <div id="minAmount" class="form-group">
            <label>Min Amount: </label>
            <div class="input-group">
              @php 
                $currency = App\Currency::first();
              @endphp
              <span class="input-group-addon"><i class="{{ $currency->icon }}"></i></span>
              <input type="number" min="0.0" value="0.00" step="0.1" class="form-control" name="minamount">
            </div>
          </div>
           <div class="form-group">
            <label>Expiry Date: </label>
            <div class="input-group">
              <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
              <input required="" id="expirydate" type="text" class="form-control" name="expirydate">
            </div>
          </div>
      </div>

    <div class="box-footer">
      <button type="submit" class="btn btn-md btn-primary">
        <i class="fa fa-plus-circle"></i> Create
      </button>
    </form>
      <a href="{{ route('coupon.index') }}" title="Cancel and go back" class="btn btn-md btn-default btn-flat">
        <i class="fa fa-reply"></i> Back
      </a>
    </div>
    </div>       
  </div>
</section>

@endsection

@section('scripts')
<script>
  (function($) {
  "use strict";
    
      $('#link_by').on('change',function(){
        var opt = $(this).val();
       
        if(opt == 'course'){
          $('#minAmount').hide();
          $('#probox').show();
          $('#minAmount').hide();
          $('#pro_id').attr('required','required');
        }else{
          $('#minAmount').show();
          $('#probox').hide();
          $('#pro_id').removeAttr('required');
        }
    });

      $('#link_by').on('change',function(){
        var opt = $(this).val();
       
        if(opt == 'category'){
          $('#catbox').show();
          $('#pro_id').attr('required','required');
        }else{
          $('#catbox').hide();
          $('#pro_id').removeAttr('required');
        }
    });

      $( function() {
        $( "#expirydate" ).datepicker({
          dateFormat : 'yy-m-d'
        });
      });

  })(jQuery);
    
</script>
 
@endsection
