@foreach ($collection_data as $collection_data_row)			  
			   <div class="item">
                  <div class="Gallery-text-overlay-Image3">
                     <a href="{{@collectionImageBasePath($collection_data_row->featured_image)}}?ixlib=rb-0.3.5&ixid=eyJhcHBfaWQiOjEyMDd9&s=d635ce56a53ed68189603030b7ee6b26&auto=format&fit=crop&w=634&q=80" class="image1" title="{{$collection_data_row->title}}">
					 <img class="owl-lazy img-fluid imagesCover img_res_mob_dec" data-src="{{@collectionImageBasePath($collection_data_row->featured_image)}}?ixlib=rb-0.3.5&ixid=eyJhcHBfaWQiOjEyMDd9&s=d635ce56a53ed68189603030b7ee6b26&auto=format&fit=crop&w=634&q=80" />
                      </a>
                      <p class="collectionShortDesc">{{ @$collection_data_row->title }}</p>
                  </div>
				  
               </div>
            @endforeach