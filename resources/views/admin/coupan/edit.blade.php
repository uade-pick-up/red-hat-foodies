@extends("admin/layouts.master")
@section('title','Edit Coupon ')
@section('body')

<section class="content">
  <div class="row">
    <div class="col-md-8">
      <div class="box box-primary">
        <div class="box-header with-border">
          <div class="box-title">
            Edit Coupon : {{ $coupan->code }}
          </div>
        </div>
        <form action="{{ route('coupon.update',$coupan->id) }}" method="POST">
          @csrf
          {{ method_field("PUT") }}

          <div class="box-body">
               
              <div class="form-group">
                <label>Coupon code: <span class="redstar">*</span></label>
                <input value="{{ $coupan->code }}" type="text" class="form-control" name="code">
              </div>
              <div class="form-group">
                <label>Discount type: <span class="redstar">*</span></label>
                
                  <select required="" name="distype" id="distype" class="form-control">
                    
                    <option {{ $coupan->distype == 'fix' ? "selected" : ""}} value="fix">Fix Amount</option>
                    <option {{ $coupan->distype == 'per' ? "selected" : ""}} value="per">% Percentage</option>
                    
                  </select>
                
              </div>
              <div class="form-group">
                  <label>Amount: <span class="redstar">*</span></label>
                  <input type="text" value="{{ $coupan->amount }}"  class="form-control" name="amount">
                
              </div>
              <div class="form-group">
                <label>Linked to: <span class="redstar">*</span></label>
                
                  <select required="" name="link_by" id="link_by" class="form-control js-example-basic-single">
                    <option {{ $coupan->link_by == 'course' ? "selected" : ""}} value="course">Link By Course</option>
                    <option {{ $coupan->link_by == 'cart' ? "selected" : ""}} value="cart">Link to Cart</option>
                    <option {{ $coupan->link_by == 'category' ? "selected" : ""}} value="category">Link to Category</option>
                  </select>
                
              </div>

              <div style="{{ $coupan->link_by == 'course' ? "" : "display: none"}}" id="probox" class="form-group">
                <label>Select Course: <span class="redstar">*</span> </label>
                <br>
                <select  id="pro_id" name="course_id" class="js-example-basic-single form-control">
                    <option value="none" selected disabled hidden> 
                      Select an Option 
                    </option>
                    @foreach(App\Course::where('status','1')->get() as $product)
                      @if($product->type == 1)
                        <option {{ $coupan->course_id == $product->id ? 'selected' : "" }} value="{{ $product->id }}">{{ $product['title'] }}</option>
                      @endif
                    @endforeach
                </select>
              </div>

              <div style="{{ $coupan->link_by == 'category' ? "" : "display: none"}}" id="catbox" class="form-group">
                <label>Select Categories: <span class="redstar">*</span> </label>
                <br>
                <select id="cat_id" name="category_id" class="js-example-basic-single form-control">
                    <option value="none" selected disabled hidden> 
                      Select an Option 
                    </option>
                    @foreach(App\Categories::where('status','1')->get() as $category)
                      <option {{ $coupan->category_id == $category->id ? 'selected' : "" }} value="{{ $category->id }}">{{ $category['title'] }}</option>
                    @endforeach
                </select>
              </div>

              <div class="form-group">
                <label>Max Usage Limit: <span class="redstar">*</span></label>
                <input value="{{ $coupan->maxusage }}" type="number" min="1" class="form-control" name="maxusage">
              </div>
              <div style="{{ $coupan->link_by=='product' ? "display:none" : "" }}" id="minAmount" class="form-group">
                <label>Min Amount: </label>
                <div class="input-group">
                  @php
                      $currency = App\Currency::first();
                  @endphp 
                  <span class="input-group-addon"><i class="{{ $currency->icon }}"></i></span>
                  <input value="{{ $coupan->minamount }}" type="number" min="0.0" value="0.00" step="0.1" class="form-control" name="minamount">
                </div>
              </div>
               <div class="form-group">
                <label>Expiry Date: </label>
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                  <input value="{{ date('Y-m-d',strtotime($coupan->expirydate)) }}" id="expirydate" type="text" class="form-control" name="expirydate">
                </div>
              </div>
          </div>

          <div class="box-footer">
            <button type="submit" class="btn btn-md btn-primary">
              <i class="fa fa-save"></i> Update
            </button>
          </form>
          <a href="{{ route('coupon.index') }}" title="Cancel and go back" class="btn btn-md btn-default btn-flat"><i class="fa fa-reply"></i> Back</a>
          </div>
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
          $('#catbox').hide();
          $('#pro_id').attr('required','required');
        }else{
          $('#minAmount').show();
          $('#probox').hide();
          $('#catbox').show();
          $('#pro_id').removeAttr('required');
        }
    });

      $('#link_by').on('change',function(){
        var opt = $(this).val();
       
        if(opt == 'category'){
          $('#catbox').show();
          $('#probox').hide();
          $('#cat_id').attr('required','required');
        }else{
          $('#catbox').hide();
          $('#probox').show();
          $('#cat_id').removeAttr('required');
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
