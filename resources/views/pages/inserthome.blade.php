<!DOCTYPE html>
<html lang="en">

@include('layouts/header')
<body>
    <?php
$page='m';
?>
@include('layouts/navbar')

	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<div class="login100-form-title">
					<span class="login100-form-title-1" style="font-family:IRANSansWeb">
					افزودن خانه جدید
					</span>
				</div>
				@if (count($errors) > 0)
      <div class="alert alert-danger">
        <strong>Whoops!</strong> There were some problems with your input.<br><br>
        <ul>
          @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
      @endif

        @if(session('success'))
        <div class="alert alert-success">
          {{ session('success') }}
        </div> 
		
        @endif
				<form class="login100-form validate-form" action="{{route('house.save')}}" method="post"  enctype="multipart/form-data">
				
				{{ csrf_field() }}
					    <input type="hidden" name="lat" id="lat">
					    <input type="hidden" name="lon" id="lon">
						<div class="wrap-input100 validate-input m-b-26 form-group row" style="margin-right:30px;" data-validate="تعداد اتاق را وارد کنید">
							  <label for="inputZip">تعداد اتاق</label>
							  <input class="input100" type="text" name="rooms" placeholder="تعداد اتاق">
								<span class="focus-input100"></span>
						</div>
					

				
					<div class="wrap-input100 validate-input m-b-26 form-group row" style="margin-right:30px;" data-validate=" طبقه را وارد کنید ">
      						<label for="inputZip">طبقه</label>
							  <input class="input100" type="text" name="floor" placeholder="طبقه" >
						<span class="focus-input100"></span>
					</div>
				
					

					<div class="wrap-input100 validate-input m-b-26 form-group row" style="margin-right:30px;" data-validate="شهر را وارد کنید">
      						<label for="inputZip">شهر</label>
							  <input class="input100" type="text" name="city" placeholder="شهر" >
						<span class="focus-input100"></span>
					</div>
						
					<div class="wrap-input100 validate-input m-b-26 form-group row" style="margin-right:30px;" data-validate="محله را وارد کنید">
      						<label for="inputZip">محله</label>
							  <input class="input100" type="text" name="location" placeholder="محله" >
						<span class="focus-input100"></span>
					</div>
    				
					<div class="wrap-input100 validate-input m-b-26 form-group row" style="margin-right:30px;" data-validate="نشانی را وارد کنید">
    						<label for="address">نشانی</label>
    						<textarea class="input100" name="address"  id="address" rows="3"></textarea>
  					</div>

					  <div class="wrap-input100 m-b-26 form-group row" style="margin-right:30px;">
      						<label for="inputZip">کدپستی</label>
							  <input class="input100" type="text" name="zip" placeholder="کدپستی" >
						<span class="focus-input100"></span>
					</div>
					
					<fieldset class="form-group">
    					<div class="row">
      						<legend class="col-form-label col-sm-2 pt-0"></legend>
      						<div class="col-sm-10">
								<div class="form-check">
  									<input class="form-check-input" type="checkbox" name="parking" value="1" id="parking">
  										<label class="form-check-label" for="parking">
    						 				پارکینگ
  										</label>
								</div>

								<div class="form-check">
  									<input class="form-check-input" type="checkbox" name="anbari" value="1" id="anbari">
  									<label class="form-check-label" for="anbari">
    						 			انباری
  									</label>
								</div>
					
								<div class="form-check">
  									<input class="form-check-input" type="checkbox" name="elevator" value="1" id="elevator">
  									<label class="form-check-label" for="elevator">
    						 			آسانسور
  									</label>
								</div>	


								<div class="form-check">
  									<input class="form-check-input" type="checkbox" name="balcony" value="1" id="balcony">
  									<label class="form-check-label" for="balcony">
    						 			بالکن
  									</label>
								</div>
							<br><br>
					
								<div class="form-check">
  									<input class="form-check-input" type="radio" name="sell" id="sale" value="1" checked>
  									<label class="form-check-label" for="sale">			
    									برای فروش
									</label>
								</div>	

								<div class="form-check">
  									<input class="form-check-input" type="radio" name="sell" id="rent" value="0">
  									<label class="form-check-label" for="rent">			
    									برای اجاره
									</label>
								</div>
							</div>
    					</div>
					  </fieldset>
					  
					 <br><br>
					  <div class="wrap-input100 validate-input m-b-26 form-group row" style="margin-right:30px;" data-validate="قیمت را وارد کنید">
      						<label for="inputZip">قیمت فروش یا رهن</label>
							  <input class="input100" type="text" name="cost" placeholder="قیمت فروش یا رهن" >
						<span class="focus-input100"></span>
					</div>

					<div class="wrap-input100 m-b-26 form-group row" style="margin-right:30px;">
      						<label for="inputZip">اجاره</label>
							  <input class="input100" type="text" name="rentcost" placeholder="اجاره" >
						<span class="focus-input100"></span>
					</div>

					<div class="wrap-input100 validate-input m-b-26 form-group row" style="margin-right:30px;" data-validate="متراژ را وارد کنید">
      						<label for="meterage">متراژ</label>
							  <input class="input100" type="text" name="meterage" placeholder="متراژ" >
						<span class="focus-input100"></span>
					</div>



					<div class="wrap-input100 m-b-26 form-group row" style="margin-right:30px;">
    					<label for="comment">توضیحات</label>
    					<textarea class="input100" id="comment" name="comment" rows="5"></textarea>
  					</div>
					
					
					  <div class="wrap-input100 validate-input m-b-26 form-group row" style="margin-right:30px;" data-validate="سال ساخت را وارد کنید">
      					<label for="year">سال ساخت</label>
      					<select id="year" name="year" class="form-control">
        					<option selected>انتخاب سال ساخت...</option>
							<?php
							$v = Verta::today(); 
							?>
							@for($i=$v->year;$i>=1301;$i--)
        						<option>{{$i}}</option>
							@endfor
      					</select>
					</div>

					  <div class="wrap-input100 validate-input m-b-26 form-group row" style="margin-right:30px;" data-validate="نوع را وارد کنید">
      					<label for="type">نوع</label>
      					<select id="type" name="type" class="form-control">
        					<option selected> نوع ...</option>
        						<option>آپارتمان</option>
								<option>ویلایی</option>
								<option>کلنگی</option>
								<option>زمین</option>
								<option>مستغلات</option>
      					</select>
					</div>
					

<br/>



      
<br/><br/>


<style>
.entry:not(:first-of-type)
{
    margin-top: 10px;
}

.fa
{
    font-size: 12px;
}
</style>
<script>
$(function()
{
    $(document).on('click', '.btn-add', function(e)
    {
        e.preventDefault();

        var controlForm = $('.controls:first'),
            currentEntry = $(this).parents('.entry:first'),
            newEntry = $(currentEntry.clone()).appendTo(controlForm);

        newEntry.find('input').val('');
        controlForm.find('.entry:not(:last) .btn-add')
            .removeClass('btn-add').addClass('btn-remove')
            .removeClass('btn-success').addClass('btn-danger')
            .html('<span class="fa fa-minus"></span>');
    }).on('click', '.btn-remove', function(e)
    {
      $(this).parents('.entry:first').remove();

		e.preventDefault();
		return false;
	});
});
</script>

 <div class="col-md-12">
      <div class="row">
      <div class="control-group" id="fields">

          <div class="controls">
           
              <div class="entry input-group col-xs-3">
                
             
                <input class="btn btn-primary" name="photo[]" type="file">
                <span class="input-group-btn">
              <button class="btn btn-success btn-add" type="button">
                                <span class="fa fa-plus"></span>
                </button>
                </span>
              </div>
           
          </div>
          
        </div>
      </div>
    </div>
<br><br>
                <div class="container-fluid">
                    <div class="row">
    					<div class="container-login100-form-btn">
                            <div id="map" style="height: 200px;width:100%;"></div>
    					</div>
    				</div>
                </div>
				<br><br>
                <div class="row">
					<div class="container-login100-form-btn" style="margin-left:70px;">
						<button type="submit" class="login100-form-btn" style="font-family:IRANSansWeb">
							ثبت
						</button>
					</div>
				</div>
					
				</form>
			</div>
		</div>
	</div>
	</div>
	
<!--===============================================================================================-->
	<script src="/js/jquery-3.2.1.min.js"></script>
	<script src="/js/login-bootstrap.min.js"></script>
	<script src="js/login-main.js"></script>
	<script>
        var map = L.map('map', {
            center: [35.6892, 51.3890],
            zoom: 10
        });
        var layer = new L.TileLayer('http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png');
        map.addLayer(layer);
        
        var marker;
        map.on('click', function(e) {
            if(marker) map.removeLayer(marker);
            marker = L.marker(e.latlng).addTo(map);
            
        });
        
        function addLatLonToInput (lanLon) {
            document.getElementById("lat").value = latLon.lat;
            document.getElementById("lon").value = latLon.lon;
        }
        
        function getLocation() {
          if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(showPosition);
          } else {
            alert("Geolocation is not supported by this browser.");
          }
        }
        function showPosition(position) {
          var lat = position.coords.latitude;
          var lng = position.coords.longitude;
          map.panTo([lat, lng]);
        }
        
        
    </script>


</body>
@include('layouts/footer')
</html>
