@extends('layouts.master')

@section('title')
	قائمة المنتجات
@endsection
@section('css')
<!-- Internal Data table css -->
<link href="{{URL::asset('assets/plugins/datatable/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet" />
<link href="{{URL::asset('assets/plugins/datatable/css/buttons.bootstrap4.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/datatable/css/responsive.bootstrap4.min.css')}}" rel="stylesheet" />
<link href="{{URL::asset('assets/plugins/datatable/css/jquery.dataTables.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/datatable/css/responsive.dataTables.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet">
<!---Internal Owl Carousel css-->
<link href="{{URL::asset('assets/plugins/owl-carousel/owl.carousel.css')}}" rel="stylesheet">
<!---Internal  Multislider css-->
<link href="{{URL::asset('assets/plugins/multislider/multislider.css')}}" rel="stylesheet">
<!--- Select2 css -->
<link href="{{URL::asset('assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet">
@endsection
@section('page-header')
				<!-- breadcrumb -->
				<div class="breadcrumb-header justify-content-between">
					<div class="my-auto">
						<div class="d-flex">
							<h4 class="content-title mb-0 my-auto">الاقسام</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ قائمة الاقسام</span>
						</div>
					</div>
				</div>
				<!-- breadcrumb -->
@endsection
@section('content')



					@if(Session::has('success'))
						<div class="alert alert-solid-success" role="alert">
							<button aria-label="Close" class="close" data-dismiss="alert" type="button">
							<span aria-hidden="true">&times;</span></button>
							{{Session::get('success')}}
						</div>
					@endif

					@error('product_name')
						<div class="alert alert-solid-danger" role="alert">
							<button aria-label="Close" class="close" data-dismiss="alert" type="button">
							<span aria-hidden="true">&times;</span></button>
							{{ $message }}
						</div>
					@enderror

					@error('section_id')
						<div class="alert alert-solid-danger" role="alert">
							<button aria-label="Close" class="close" data-dismiss="alert" type="button">
							<span aria-hidden="true">&times;</span></button>
							{{ $message }}
						</div>
					@enderror

					@error('description')
						<div class="alert alert-solid-danger" role="alert">
							<button aria-label="Close" class="close" data-dismiss="alert" type="button">
							<span aria-hidden="true">&times;</span></button>
							{{ $message }}
						</div>
					@enderror
				<!-- row opened -->
				<div class="row row-sm">
					<!--div-->
					<div class="col-xl-12">
						<div class="card mg-b-20">
							<div class="card-header pb-0">
								<div class="col-sm-6 col-md-4 col-xl-3">
									

									<a class="modal-effect btn btn-outline-primary btn-block" data-effect="effect-scale" data-toggle="modal" href="#modaldemo8">إضافة منتج</a>
								</div>
							</div>
							<div class="card-body">
								<div class="table-responsive">
									<table id="example1" class="table key-buttons text-md-nowrap" data-page-length="50">
										<thead>
											<tr>
												<th class="border-bottom-0">#</th>
												<th class="border-bottom-0">اسم المنتج</th>
												<th class="border-bottom-0">اسم القسم</th>
												<th class="border-bottom-0">وصف المنتج</th>
												<th class="border-bottom-0">الاجراءات</th>
											</tr>
										</thead>
										<tbody>
											@forelse ($products as $product)
												<tr>
													<td>{{ $loop->index + 1 }}</td>
													{{--  <td>{{ $section->id }}</td>  --}}
													<td>{{ $product->product_name }}</td>
													<td>{{ $product->section->section_name }}</td>
													<td>{{ $product->description }}</td>
													<td>
														<a class="modal-effect btn btn-sm btn-info" data-effect="effect-scale"
														   data-id="{{ $product->id }}" data-product_name="{{ $product->product_name }}"
														   data-description="{{ $product->description }}" data-toggle="modal" href="#exampleModal2"
														   title="تعديل"><i class="las la-pen"></i></a>
	
														<a class="modal-effect btn btn-sm btn-danger" data-effect="effect-scale"
														   data-id="{{ $product->id }}" data-product_name="{{ $product->product_name }}" data-toggle="modal"
														   href="#modaldemo9" title="حذف"><i class="las la-trash"></i></a>
												</td>
												</tr>
											@empty
												<li>لم يتم العثور على بيانات</li>
											@endforelse
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>
					<!--/div-->

					<!-- Modal effects -->
					<div class="modal" id="modaldemo8">
						<div class="modal-dialog modal-dialog-centered" role="document">
							<div class="modal-content modal-content-demo">
								<div class="modal-header">
									<h6 class="modal-title">أضافة منتج</h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
								</div>
								<div class="modal-body">
									<form class="needs-validation" method="POST" action="{{ route('products.store') }}">
										@csrf
										<div class="row row-sm">
											<div class="col-lg-12">
												<div class="form-group mg-b-10">
													<input name="product_name" class="form-control @error('product_name') is-invalid @enderror" placeholder="اسم المنتج" type="text" value="">
													@error('product_name')
														<span class="text-danger">{{ $message }}</span>
													@enderror
												</div>
											</div>

											<div class="col-lg-12">
												<div class="form-group mg-b-10">
													<select name="section_id" id="section_id" class="form-control">
														<option value="" selected disabled> --حدد القسم--</option>
														@foreach ($sections as $section)
															<option value="{{ $section->id }}">{{ $section->section_name }}</option>
														@endforeach
													</select>
													@error('section_id')
														<span class="text-danger">{{ $message }}</span>
													@enderror
												</div>
											</div>

											

											<div class="col-lg-12">
												<div class="form-group mg-b-10">
													<textarea name="description" class="form-control mg-t-20 @error('description') is-invalid @enderror" placeholder="وصف المنتج" rows="3"></textarea>
													@error('description')
														<span class="text-danger">{{ $message }}</span>
													@enderror
												</div>
											</div>
										</div>
										<div class="modal-footer">
											<button class="btn ripple btn-primary" type="submit">حفظ</button>
											<button class="btn ripple btn-secondary" data-dismiss="modal" type="button">تراجع</button>
										</div>
									</form>
								</div>
								
							</div>
						</div>
					</div>

					<!-- edit -->
				<div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
				   	<div class="modal-dialog" role="document">
					   <div class="modal-content">
						   <div class="modal-header">
							   <h5 class="modal-title" id="exampleModalLabel">تعديل المنتج</h5>
							   <button type="button" class="close" data-dismiss="modal" aria-label="Close">
								   <span aria-hidden="true">&times;</span>
							   </button>
						   </div>
						   <div class="modal-body">

							   <form action="{{ route('products.update', $product->id) }}" method="post" autocomplete="off">
								   @method('PUT')
								   @csrf
								   <div class="form-group">
									   <input type="hidden" name="id" id="id" value="">
									   <input class="form-control" name="product_name" id="product_name" type="text" >
								   </div>
								   <div class="form-group">
									   <textarea class="form-control" id="description" name="description"></textarea>
								   </div>
						   </div>
						   <div class="modal-footer">
							   <button type="submit" class="btn btn-primary">تاكيد</button>
							   <button type="button" class="btn btn-secondary" data-dismiss="modal">اغلاق</button>
						   </div>
						   </form>
					   </div>
				   </div>
			   </div>

			   <!-- delete -->
			   <div class="modal" id="modaldemo9">
				<div class="modal-dialog modal-dialog-centered" role="document">
					<div class="modal-content modal-content-demo">
						<div class="modal-header">
							<h6 class="modal-title">حذف المنتج</h6><button aria-label="Close" class="close" data-dismiss="modal"
																		   type="button"><span aria-hidden="true">&times;</span></button>
						</div>
						<form action="{{ route('products.destroy', $product->id) }}" method="post">
							{{method_field('delete')}}
							{{csrf_field()}}
							<div class="modal-body">
								<p>هل انت متاكد من عملية الحذف ؟</p><br>
								<input type="hidden" name="id" id="id" value="">
								<input class="form-control" name="product_name" id="product_name" type="text" readonly>
							</div>
							<div class="modal-footer">
								<button type="submit" class="btn btn-danger">تاكيد</button>
								<button type="button" class="btn btn-secondary" data-dismiss="modal">الغاء</button>
							</div>
					</div>
					</form>
				</div>
			</div>
					<!-- End Modal effects-->

				</div>
				<!-- /row -->
			</div>
			<!-- Container closed -->
		</div>
		<!-- main-content closed -->
@endsection
@section('js')
<!-- Internal Data tables -->
<script src="{{URL::asset('assets/plugins/datatable/js/jquery.dataTables.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.dataTables.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/responsive.dataTables.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/jquery.dataTables.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.bootstrap4.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.buttons.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/buttons.bootstrap4.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/jszip.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/pdfmake.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/vfs_fonts.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/buttons.html5.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/buttons.print.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/buttons.colVis.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/responsive.bootstrap4.min.js')}}"></script>
<!--Internal  Datatable js -->
<script src="{{URL::asset('assets/js/table-data.js')}}"></script>
<!--Internal  Datepicker js -->
<script src="{{URL::asset('assets/plugins/jquery-ui/ui/widgets/datepicker.js')}}"></script>
<!-- Internal Select2 js-->
<script src="{{URL::asset('assets/plugins/select2/js/select2.min.js')}}"></script>
<!-- Internal Modal js-->
<script src="{{URL::asset('assets/js/modal.js')}}"></script>
<script>
	$('#exampleModal2').on('show.bs.modal', function(event) {
		var button = $(event.relatedTarget)
		var id = button.data('id')
		var product_name = button.data('product_name')
		var description = button.data('description')
		var modal = $(this)
		modal.find('.modal-body #id').val(id);
		modal.find('.modal-body #product_name').val(product_name);
		modal.find('.modal-body #description').val(description);
	})
</script>

<script>
        $('#modaldemo9').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var id = button.data('id')
            var product_name = button.data('product_name')
            var modal = $(this)
            modal.find('.modal-body #id').val(id);
            modal.find('.modal-body #product_name').val(product_name);
        })
    </script>
@endsection



