{{-- auto click --}}
<script>
    $(document).ready(function() {
        // auto click
        $('.auto-click').click();
    })
</script>

{{-- add product to cart --}}
<script>
    $(document).ready(function() {
        // laravel csrf
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        // buy product now
        $('.buy-product-now').on('submit', function(e) {
            e.preventDefault();

            let product_data = $(this).serialize();
            // console.log(product_data); 

            $.ajax({
                method: 'POST',
                data: product_data,
                url: "{{ route('cart.buy-product-now') }}",
                success: function(data) {
                    if (data.status == 'success') {
                        // add product to cart successfully after count product on mini cart
                        countProductCart()

                        // add button on mini cart after add product to cart 
                        $('.mini_cart_actions').removeClass('d-none')

                        //update product mini cart
                        getProductsCart()

                        window.location.href = "{{ route('cart.cart-detail') }}";
                    } else if (data.status == 'error') {
                        toastr.error(data.message)
                    } else if (data.status == 'warning') {
                        toastr.warning(data.message)
                    }
                },
                error: function(data) {},
            })
        })

        // add product to cart
        $('.add-product-to-cart').on('submit', function(e) {
            e.preventDefault();

            let product_data = $(this).serialize();
            // console.log(product_data); 

            $.ajax({
                method: 'POST',
                data: product_data,
                url: "{{ route('cart.add-product-to-cart') }}",
                success: function(data) {
                    if (data.status == 'success') {
                        // add product to cart successfully after count product on mini cart
                        countProductCart()

                        // add button on mini cart after add product to cart 
                        $('.mini_cart_actions').removeClass('d-none')

                        //update product mini cart
                        getProductsCart()

                        toastr.success(data.message)

                    } else if (data.status == 'error') {
                        toastr.error(data.message)
                    } else if (data.status == 'warning') {
                        toastr.warning(data.message)
                    }
                },
                error: function(data) {},
            })
        })

        // increment product quantity on cart
        $('.cart-pro-qty-btn-increment').on('click', function(e) {
            let input = $(this).siblings('.cart-pro-qty-input')
            let quantity = parseInt(input.val()) + 1

            //get rowId of product in cart
            let row_id = input.data('id')

            //update input value after increment product quantity
            input.val(quantity)

            $.ajax({
                url: "{{ route('cart.update-product-quantity') }}",
                method: 'POST',
                data: {
                    rowId: row_id,
                    qty: quantity,
                },
                success: function(data) {
                    if (data.status == 'success') {
                        // get elementByClass of total product price
                        let total_product_price_id = '.' + row_id

                        // print value of total product price
                        // console.log($(total_product_price_id).text());
                        // console.log(typeof data.product_total_price);

                        let total_product_price = Number(data.total_product_price)
                            .toLocaleString('vi-VN', {
                                minimumFractionDigits: 0
                            }) + "{{ $settings->currency_icon }}"

                        //update total_product_price after incrementing
                        $(total_product_price_id).text(total_product_price);

                        //update product mini cart
                        getProductsCart()

                        // update total cart price on mini cart after increment product quantity on cart
                        getTotalCartPrice();

                        // calculate voucher discount after increment product quantity
                        calculateVoucherDiscount();

                        toastr.success(data.message)
                    } else if (data.status == 'error') {
                        toastr.error(data.message)
                    } else if (data.status == 'warning') {
                        toastr.warning(data.message)
                    }
                },
                error: function(data) {}
            })
        })

        // decrement product quantity on cart
        $('.cart-pro-qty-btn-decrement').on('click', function(e) {
            let input = $(this).siblings('.cart-pro-qty-input')
            let quantity = parseInt(input.val()) - 1
            //get rowId of product in cart
            let row_id = input.data('id')

            // min quantity is 1
            if (quantity < 1) {
                quantity = 1

                e.preventDefault();

                Swal.fire({
                    title: 'Bạn muốn xóa sản phẩm?',
                    text: "",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    cancelButtonText: 'Thoát',
                    confirmButtonText: 'Đồng ý'
                }).then((result) => {
                    if (result.isConfirmed) {

                        $.ajax({
                            type: 'GET',
                            url: `{{ url('cart/delete-product-cart/${row_id}') }}`,
                            success: function(data) {
                                Swal.fire(
                                    'Đã xóa',
                                    'Xóa sản phẩm thành công!',
                                    'success'
                                )

                                // reload page after delele product on cart
                                window.location.reload();
                            },
                            error: function(xhr, status, error) {
                                console.log(error);
                            }
                        });
                    } else {
                        quantity = 1
                    }
                })
            }

            //update input value after decrement product quantity
            input.val(quantity)

            $.ajax({
                url: "{{ route('cart.update-product-quantity') }}",
                method: 'POST',
                data: {
                    rowId: row_id,
                    qty: quantity,
                },
                success: function(data) {
                    if (data.status == 'success') {
                        // get elementByClass of product total price
                        let total_product_price_id = '.' + row_id

                        // print value of product total price
                        // console.log($(total_product_price_id).text());
                        // console.log(typeof data.product_total_price);

                        let total_product_price = Number(data.total_product_price)
                            .toLocaleString('vi-VN', {
                                minimumFractionDigits: 0
                            }) + "{{ $settings->currency_icon }}"

                        //update total_product_price after incrementing
                        $(total_product_price_id).text(total_product_price);

                        //update product mini cart
                        getProductsCart()

                        // update total cart price on mini cart after decrement product quantity on cart
                        getTotalCartPrice();

                        // calculate voucher discount after decrement product quantity
                        calculateVoucherDiscount();

                        if (quantity > 1) {
                            toastr.success(data.message)
                        }
                    } else if (data.status == 'error' && quantity > 1) {
                        toastr.error(data.message)
                    } else if (data.status == 'warning') {
                        toastr.warning(data.message)
                    }
                },
                error: function(data) {}
            })
        })

        // delete product cart
        $('.delete-product-cart').on('click', function(e) {
            e.preventDefault();

            let row_id = $(this).data('id')
            // console.log(row_id);

            Swal.fire({
                title: 'Bạn muốn xóa sản phẩm?',
                text: "",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                cancelButtonText: 'Thoát',
                confirmButtonText: 'Đồng ý'
            }).then((result) => {
                if (result.isConfirmed) {

                    $.ajax({
                        type: 'GET',
                        url: `{{ url('cart/delete-product-cart/${row_id}') }}`,
                        success: function(data) {
                            Swal.fire(
                                'Đã xóa',
                                'Xóa sản phẩm thành công!',
                                'success'
                            )

                            // reload page after delete product on cart
                            window.location.reload();
                        },
                        error: function(xhr, status, error) {
                            console.log(error);
                        }
                    });
                }
            })

        })

        // clear cart
        $('.cleart-cart').on('click', function(e) {
            e.preventDefault();

            Swal.fire({
                title: 'Bạn muốn xóa giỏ hàng?',
                text: "",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                cancelButtonText: 'Thoát',
                confirmButtonText: 'Đồng ý'
            }).then((result) => {
                if (result.isConfirmed) {

                    $.ajax({
                        type: 'GET',
                        url: "{{ route('cart.clear-cart') }}",
                        success: function(data) {
                            Swal.fire(
                                'Đã xóa',
                                data.message,
                                'success'
                            )

                            // reload page after cleart cart
                            window.location.reload();
                        },
                        error: function(xhr, status, error) {
                            console.log(error);
                        }
                    });
                }
            })
        })

        // apply voucher to cart
        $('.apply-voucher-to-cart').on('submit', function(e) {
            // .apply-voucher-to-cart is class cart-details.blade.php
            e.preventDefault();

            // get value voucher
            let voucher_data = $(this).serialize();

            $.ajax({
                method: 'GET',
                data: voucher_data,
                url: "{{ route('cart.apply-voucher-to-cart') }}",
                success: function(data) {
                    if (data.status == 'success') {
                        // calculate voucher discount after apply voucher code
                        calculateVoucherDiscount();

                        // reload page after apply voucher to cart
                        window.location.reload();
                        toastr.success(data.message)
                    } else if (data.status == 'warning') {
                        toastr.warning(data.message)
                    } else if (data.status == 'error') {
                        toastr.error(data.message)
                    }

                },
                error: function(data) {},
            })

        })

        // delete voucher to cart
        $('.delete-voucher-to-cart').on('submit', function(e) {
            // .delete-voucher-to-cart is class cart-details.blade.php
            e.preventDefault();

            $.ajax({
                method: 'GET',
                url: "{{ route('cart.delete-voucher-to-cart') }}",
                success: function(data) {
                    if (data.status == 'success') {
                        // calculate voucher discount after delete voucher code
                        calculateVoucherDiscount();

                        // reload page after delete voucher to cart
                        window.location.reload();
                        toastr.success(data.message)
                    } else {
                        toastr.error(data.message)
                    }
                },
                error: function(data) {},
            })

        })

        // count products on cart
        function countProductCart() {
            $.ajax({
                method: 'GET',
                url: "{{ route('cart.count-product-cart') }}",
                success: function(data) {
                    // console.log(data);

                    // update total product on mini cart
                    $('.total-product-mini-cart').text(
                        data
                    ) // total-product-mini-cart on cart is class element in header.blade.php file
                },
                error: function(data) {},
            })
        }

        // get products on cart
        function getProductsCart() {
            $.ajax({
                method: 'GET',
                url: "{{ route('cart.get-products-cart') }}",
                success: function(data) {
                    // console.log(data);
                    $('.mini-cart').html("") //mini-cart is class element in header.blade.php file

                    var mini_cart_html = ''

                    for (let value in data) {
                        let product = data[value];
                        let total_product_price = product.price + product.options
                            .variant_total_price

                        // update mini cart after product to cart
                        mini_cart_html += `
                        <li class="product-mini-cart-${product.rowId}">
                            <div class="wsus__cart_img">
                                <a href="{{ url('product-detail/${product.options.slug}/${product.id}') }}"><img src="{{ asset('${product.options.thumbnail_image}') }}" class="img-fluid w-100"></a>

                            </div>
                            <div class="wsus__cart_text">
                                <a class="wsus__cart_title" href="{{ url('product-detail/${product.options.slug}/${product.id}') }}">${product.name}</a>

                                ${Object.entries(product.options.variants).map(([key, variant]) => `
                                        <div>
                                            <small>
                                                ${key}: ${variant.name}
                                            </small>
                                        </div>
                                `).join('')}

                                <p>
                                    ${Number(total_product_price).toLocaleString('vi-VN', {minimumFractionDigits: 0})}{{ $settings->currency_icon }}
                                    <span>x${product.qty}</span>
                                </p>
                            </div>
                        </li>`
                    }

                    $('.mini-cart').html(mini_cart_html)

                    // update total cart price on mini cart after add product to cart
                    getTotalCartPrice();
                },
                error: function(data) {},
            })
        }

        // get total cart price
        function getTotalCartPrice() {
            $.ajax({
                method: 'GET',
                url: "{{ route('cart.total-cart-price') }}",
                success: function(data) {
                    // console.log(data);
                    let total_mini_cart_price = Number(data).toLocaleString(
                        'vi-VN', {
                            minimumFractionDigits: 0
                        })

                    let total_cart_price = Number(data).toLocaleString(
                        'vi-VN', {
                            minimumFractionDigits: 0
                        })

                    // #total-mini-cart-price is id element in header.blade.php
                    $('#total-mini-cart-price').text(
                        `${total_mini_cart_price}{{ $settings->currency_icon }}`)

                    // #total-cart-price is id element in cart-details.blade.php
                    $('#total-cart-price').text(
                        `${total_cart_price}{{ $settings->currency_icon }}`)

                },
                error: function(data) {},
            })
        }

        // calculate voucher discount
        function calculateVoucherDiscount() {
            $.ajax({
                method: 'GET',
                url: "{{ route('cart.calculate-voucher-discount') }}",
                success: function(data) {
                    if (data.status == 'success') {
                        let discount = data.discount
                        let final_total_cart_price = data.final_total_cart_price

                        // #discount is id of element in cart-details.blade.php
                        $('#discount').text(
                            `-${Number(discount).toLocaleString('vi-VN', {minimumFractionDigits: 0})}{{ $settings->currency_icon }}`
                        );

                        // #final_total_cart_price is id of element in cart-details.blade.php
                        $('#final_total_cart_price').text(
                            `${Number(final_total_cart_price).toLocaleString('vi-VN', {minimumFractionDigits: 0})}{{ $settings->currency_icon }}`
                        );
                    }

                },
                error: function(data) {},
            })
        }
    })
</script>

{{-- select city/district/ward --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.21.1/axios.min.js"></script>
<script>
    var citis = document.getElementById("city");
    var districts = document.getElementById("district");
    var wards = document.getElementById("ward");
    var Parameter = {
        url: "https://raw.githubusercontent.com/kenzouno1/DiaGioiHanhChinhVN/master/data.json",
        method: "GET",
        responseType: "application/json",
    };
    var promise = axios(Parameter);
    promise.then(function(result) {
        renderCity(result.data);
    });

    function renderCity(data) {
        for (const x of data) {
            citis.options[citis.options.length] = new Option(x.Name, x.Name);
        }
        citis.onchange = function() {
            district.length = 1;
            ward.length = 1;
            if (this.value != "") {
                const result = data.filter(n => n.Name === this.value);

                for (const k of result[0].Districts) {
                    district.options[district.options.length] = new Option(k.Name, k.Name);
                }
            }
        };
        district.onchange = function() {
            ward.length = 1;
            const dataCity = data.filter((n) => n.Name === citis.value);
            if (this.value != "") {
                const dataWards = dataCity[0].Districts.filter(n => n.Name === this.value)[0].Wards;

                for (const w of dataWards) {
                    wards.options[wards.options.length] = new Option(w.Name, w.Name);
                }
            }
        };
    }
</script>

{{-- get checkout info --}}
<script>
    $(document).ready(function() {
        // laravel csrf
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        // unchecked input radio
        $('input[type="radio"]').prop('checked', false);

        // set initial shipping-method-id is ""
        $('#shipping-method-id').val("")

        // set initial address-id is ""
        $('#address-id').val("")

        $('.shipping-method').on('click', function() {
            //get shipping method id
            let shipping_method_id = $(this).val()
            //get shipping fee
            let shipping_fee = $(this).data('cost')
            // get final total cart price
            let final_total_cart_price = $('#net-total-cart-price').data('final-total-cart-price')
            // calculate net total cart price after sub shipping fee
            let net_total_cart_price = final_total_cart_price + shipping_fee

            //get id of shipping method for checkout cart form
            $('#shipping-method-id').val(shipping_method_id)

            $('#shipping-fee').text(
                `+${Number(shipping_fee).toLocaleString('vi-VN', {minimumFractionDigits: 0})}{{ $settings->currency_icon }}`
            )

            $('#net-total-cart-price').text(
                `${Number(net_total_cart_price).toLocaleString('vi-VN', {minimumFractionDigits: 0})}{{ $settings->currency_icon }}`
            )

        })

        $('.address').on('click', function() {
            //get address id
            let adrress_id = $(this).data('id')

            //get id of address for checkout cart form
            $('#address-id').val(adrress_id)
        })

        // submit checkout cart form
        $('.submit-chekout-cart').on('click', function(e) {
            e.preventDefault();

            // get data checkout cart
            let data_checkout_cart = $('#checkout-cart').serialize();

            if ($('#shipping-method-id').val() == "" && $('#address-id').val() == "") {
                toastr.error('Vui lòng chọn phương thức vận chuyển và địa chỉ giao hàng!')
            } else if ($(
                    '#shipping-method-id').val() == "") {
                toastr.error('Vui lòng chọn phương thức vận chuyển!')
            } else if ($('#address-id').val() == "") {
                toastr.error('Vui lòng chọn địa chỉ giao hàng!')
            } else if (!$('.agree-term-and-condition').prop('checked')) {
                toastr.error('Vui lòng đồng ý các điều khoản và điều kiện!')
            } else {
                $.ajax({
                    method: 'POST',
                    data: data_checkout_cart,
                    url: "{{ route('user.checkout.submit') }}",
                    beforeSend: function(data) {
                        // create loading icon
                        $('.submit-chekout-cart').html(
                            '<i class="fas fa-spinner fa-spin fa-1x"></i>')
                    },
                    success: function(data) {
                        if (data.status == 'success') {
                            $('.submit-chekout-cart').text(
                                'Đang đặt hàng')

                            // redirect payment url
                            window.location.href = data.redirect_url
                        }
                    },
                    error: function(data) {
                        console.log(data);
                    }
                })
            }
        })
    })
</script>

{{-- filter price --}}
<script>
    $(document).ready(function() {
        @php
            if (request()->has('price_range')) {
                $price = explode(';', request()->price_range);
                $min_price = $price[0];
                $max_price = $price[1];
            } else {
                $min_price = 0;
                $max_price = 1000000;
            }

        @endphp

        jQuery(function() {
            jQuery("#slider_range").flatslider({
                min: 0,
                max: 1000000,
                step: 100,
                values: [{{ $min_price }}, {{ $max_price }}],
                range: true,
                einheit: "{{ $settings->currency_icon }}",
            });
        });
    })
</script>

{{-- add product to wishlist --}}
<script>
    $(document).ready(function() {
        // laravel csrf
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('.add-product-to-wishlist').on('click', function(e) {
            e.preventDefault();

            let product_id = $(this).data('id');

            $.ajax({
                method: 'GET',
                url: "{{ route('user.wishlist.add-product') }}",
                data: {
                    id: product_id
                },
                success: function(data) {
                    if (data.status == 'success') {
                        countProductWishlist()
                        toastr.success(data.message)
                    } else if (data.status == 'error') {
                        toastr.error(data.message)
                    }
                    // else if (data.status == 'warning') {
                    //     toastr.warning(data.message)
                    // }
                },
                error: function(data) {
                    toastr.error('Vui lòng đăng nhập!');
                }
            })
        })

        function countProductWishlist() {
            $.ajax({
                method: 'GET',
                url: "{{ route('user.wishlist.count-product') }}",
                success: function(data) {

                    // update total product on wishlist
                    $('.total-product-wishlist').text(
                        data
                    )
                },
                error: function(data) {},
            })
        }
    });
</script>

{{-- newsletter --}}
<script>
    $(document).ready(function() {
        $('#newsletter').on('submit', function(e) {
            e.preventDefault();
            let data = $(this).serialize();

            $.ajax({
                method: 'POST',
                url: "{{ route('newsletter.request') }}",
                data: data,
                success: function(data) {
                    if (data.status == 'success') {
                        $('.newsletter_email').val('');

                        toastr.success(data.message);
                    } else if (data.status == 'warning') {
                        toastr.warning(data.message)
                    } else if (data.status == 'error') {
                        toastr.error(data.message)
                    }
                },
                error: function(data) {
                    let errors = data.responseJSON.errors;
                    if (errors) {
                        $.each(errors, function(key, value) {
                            toastr.error(value)
                        })

                    }
                }
            })
        });
    })
</script>
