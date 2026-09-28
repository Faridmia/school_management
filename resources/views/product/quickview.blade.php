<div class="container quickView-container">
    <div class="quickView-content">
        <div class="row">
            <!-- Left Column: Product Images (WooCommerce Style Layout) -->
            <div class="col-lg-6 col-md-6 col-12">
                <div class="product-left-gallery" style="display: flex; flex-direction: column;">
                    <!-- Main Full-Width Product Image -->
                    <div class="product-main-image-wrap" style="width: 100%; border: 1px solid #eee; border-radius: 4px; padding: 10px; background: #fff; text-align: center; display: flex; align-items: center; justify-content: center; min-height: 380px;">
                        @php
                            $firstImage = $product->getImages->first() ? $product->getImages->first()->getImagesLogo() : url('upload/products/woocommerce-placeholder.png');
                        @endphp
                        <img id="quickview-main-img" src="{{ $firstImage }}" alt="{{ $product->product_title }}" style="max-width: 100%; max-height: 380px; object-fit: contain;">
                    </div>

                    <!-- Multiple Variation Images Grid -->
                    @if($product->getImages->count() > 1)
                        <div class="product-quickview-thumbnails-grid" style="display: flex; gap: 10px; flex-wrap: wrap; margin-top: 15px; justify-content: start;">
                            @foreach($product->getImages as $index => $image)
                                <a href="#" class="quickview-thumb-link {{ $index == 0 ? 'active' : '' }}" data-image-url="{{ $image->getImagesLogo() }}" style="width: 70px; height: 70px; border: 2px solid {{ $index == 0 ? '#cc9966' : '#eee' }}; border-radius: 4px; display: block; overflow: hidden; padding: 2px; background: #fff; transition: all 0.2s; cursor: pointer;">
                                    <img src="{{ $image->getImagesLogo() }}" alt="Thumbnail" style="width: 100%; height: 100%; object-fit: cover;">
                                </a>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
            
            <!-- Right Column: Product Details -->
            <div class="col-lg-6 col-md-6 col-12">
                <div class="product-details" style="padding-left: 10px;">
                    <div class="product-cat" style="font-size: 1.3rem; margin-bottom: 0.8rem; text-transform: uppercase; color: #999;">
                        @if($product->getCategory)
                            <a href="{{ url($product->getCategory->category_slug) }}" style="color: #999;">{{ $product->getCategory->name }}</a>
                        @endif
                        @if($product->getSubCategory)
                            / <a href="{{ url($product->getCategory->category_slug . '/' . $product->getSubCategory->category_slug) }}" style="color: #999;">{{ $product->getSubCategory->name }}</a>
                        @endif
                    </div>
                    
                    <h2 class="product-title" style="font-size: 2.4rem; font-weight: 600; margin-bottom: 1.2rem; color: #333; line-height: 1.2;">{{ $product->product_title }}</h2>
                    
                    <div class="ratings-container" style="display: flex; align-items: center; margin-bottom: 1.2rem; gap: 8px;">
                        <div class="ratings" style="font-size: 1.4rem; color: #cc9966; position: relative; width: 80px; display: inline-block;">
                            <div class="ratings-val" style="width: {{ $avgRating * 20 }}%; display: block; height: 100%; overflow: hidden; background: #fff;"></div>
                        </div>
                        <span class="ratings-text" style="font-size: 1.3rem; color: #999;">( {{ $reviewsCount }} {{ $reviewsCount == 1 ? 'Review' : 'Reviews' }} )</span>
                    </div>
                    
                    <div class="stock-status" style="margin-bottom: 1.2rem; color: #28a745; font-weight: 500; font-size: 1.4rem; display: flex; align-items: center; gap: 5px;">
                        <i class="icon-check"></i> In stock
                    </div>
                    
                    <div class="product-price" style="font-size: 2.2rem; font-weight: 600; margin-bottom: 1.5rem; color: #cc9966;">
                        @if($product->sale_price && $product->sale_price < $product->price)
                            <span class="new-price" id="getQuickTotalPrice">${{ number_format($product->sale_price, 2) }}</span>
                            <span class="old-price" id="getQuickOldPrice" style="text-decoration: line-through; color: #cccccc; margin-left: 10px; font-size: 1.8rem; font-weight: 400;">${{ number_format($product->price, 2) }}</span>
                        @else
                            <span class="new-price" id="getQuickTotalPrice">${{ number_format($product->price, 2) }}</span>
                        @endif
                    </div>
                    
                    <!-- Short Description (HTML Parsed) -->
                    <div class="product-content" style="font-size: 1.4rem; line-height: 1.6; color: #666; margin-bottom: 1.8rem;">
                        {!! $product->short_description !!}
                    </div>
                    
                    <form action="{{ url('product/add-to-cart') }}" method="POST">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                        <input type="hidden" name="product_price" value="{{ $product->price }}">
                        <input type="hidden" name="product_sale_price" value="{{ $product->sale_price }}">
                        <input type="hidden" name="product_name" value="{{ $product->product_title }}">
                        <input type="hidden" name="product_slug" value="{{ $product->slug }}">
                        <input type="hidden" name="product_image" value="{{ $product->getImages->first() ? $product->getImages->first()->getImagesLogo() : '' }}">
                        
                        @if($product->getColors->count() > 0)
                            <div class="details-filter-row details-row-size" style="display: flex; align-items: center; margin-bottom: 1.2rem;">
                                <label style="min-width: 60px; font-size: 1.4rem; margin-bottom: 0; font-weight: 400; color: #333;">Color:</label>
                                <div class="select-custom" style="flex: 1;">
                                    <select name="color_id" id="quick_color_id" class="form-control" required style="font-size: 1.3rem; height: 40px; padding: 0.8rem 2rem;">
                                        <option value="">Select a Color</option>
                                        @foreach($product->getColors as $color)
                                            <option value="{{ $color->getColor->color_id }}">{{ $color->getColor->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        @endif
                        
                        @if($product->getSize->count() > 0)
                            <div class="details-filter-row details-row-size" style="display: flex; align-items: center; margin-bottom: 1.2rem;">
                                <label style="min-width: 60px; font-size: 1.4rem; margin-bottom: 0; font-weight: 400; color: #333;">Size:</label>
                                <div class="select-custom" style="flex: 1;">
                                    <select name="size_id" id="quick_size_id" required class="form-control getPriceBySize" style="font-size: 1.3rem; height: 40px; padding: 0.8rem 2rem;">
                                        <option data-price="0" value="">Select a size</option>
                                        @foreach($product->getSize as $size)
                                            <option data-price="{{ !empty($size->price) ? $size->price : 0 }}" value="{{ $size->id }}">{{ $size->name }} @if(!empty($size->price)) (${{ number_format($size->price, 2) }}) @endif</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        @endif
                        
                        <div class="details-filter-row details-row-size" style="display: flex; align-items: center; margin-bottom: 1.8rem;">
                            <label style="min-width: 60px; font-size: 1.4rem; margin-bottom: 0; font-weight: 400; color: #333;">Qty:</label>
                            <div class="product-details-quantity">
                                <input name="quantity" type="number" id="quick_qty" class="form-control" value="1" min="1" max="100" step="1" required style="width: 70px; text-align: center; height: 40px; font-size: 1.3rem;">
                            </div>
                        </div>
                        
                        <div class="product-details-action" style="margin-bottom: 1.8rem;">
                            <button type="submit" class="btn-product btn-cart" style="background: #cc9966; color: #fff; border: 1px solid #cc9966; padding: 1.1rem 3rem; font-size: 1.4rem; font-weight: 500; cursor: pointer; text-transform: uppercase; width: 100%; border-radius: 4px; display: inline-flex; align-items: center; justify-content: center; gap: 8px;">
                                <i class="icon-shopping-cart"></i> Add to Cart
                            </button>
                        </div>
                    </form>
                    
                    <div class="product-details-footer" style="border-top: 1px solid #ebebeb; padding-top: 1.2rem; font-size: 1.3rem; color: #999;">
                        <div class="product-sku" style="margin-bottom: 0.5rem;">
                            <span>SKU:</span> <strong>{{ $product->sku }}</strong>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <script>
        // WooCommerce variation-like image switcher and pricing logic
        jQuery(document).ready(function ($) {
            // Switch main image when thumbnail is clicked
            $('.quickView-content').on('click', '.quickview-thumb-link', function (e) {
                e.preventDefault();
                var newSrc = $(this).data('image-url');
                
                // Update main image source
                $('#quickview-main-img').attr('src', newSrc);
                
                // Update active thumbnail borders
                $(this).addClass('active').css('border-color', '#cc9966')
                       .siblings().removeClass('active').css('border-color', '#eee');
            });

            // Dynamic price recalculation based on selected size
            $('.quickView-content').on('change', '.getPriceBySize', function () {
                let regularPrice = parseFloat('{{ $product->price }}') || 0;
                let salePrice    = parseFloat('{{ $product->sale_price ?? 0 }}') || 0;
                let sizePrice    = parseFloat($(this).find(':selected').data('price')) || 0;

                if (salePrice > 0 && salePrice < regularPrice) {
                    $('#getQuickTotalPrice').text('$' + (salePrice + sizePrice).toFixed(2));
                    $('#getQuickOldPrice').text('$' + (regularPrice + sizePrice).toFixed(2));
                } else {
                    $('#getQuickTotalPrice').text('$' + (regularPrice + sizePrice).toFixed(2));
                }
            });
        });
    </script>
</div>
