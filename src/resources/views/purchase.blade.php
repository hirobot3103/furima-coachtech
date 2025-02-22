@extends('layouts.cmn')

@section('subtitle', '購入画面')

@section('csslink')
    <link rel="stylesheet" href="{{ asset( '/assets/css/purchase.css' ) }}">
@endsection

@section('page-main')
    
    <x-header>
        @isset($session['keyword'])
            <x-slot name="keyword">{{ $urlData['keyword'] }}</x-slot>
        @else
            <x-slot name="keyword"></x-slot>
        @endisset
    </x-header>

    <main class="contents">
        <div class="contents-area">
            <section class="item-info-area">
                <section class="img-area">
                    <ul>
                        <li class="item-img">
                            @php
                                $soldOutClass = "";
                            @endphp  

                            @if ( $itemData['soldout'] == 1)
                            <div class="item-sold-out__discript">
                                <span>Sold</span>
                            </div>
                    
                            @php
                                $soldOutClass = "item-sold-out__img";
                            @endphp
                            @endif
                            <img class="{{ $soldOutClass }}" src="{{ $itemData[ 'img_url' ] }}" alt="{{ $itemData[ 'item_name' ] }}">

                        </li>
                        <li class="item-info">
                            <p class="item-name">{{ $itemData[ 'item_name' ] }}</p>
                            <p class="price">&yen;{{ number_format( $itemData[ 'price' ] ) }}</p>
                        </li>
                    </ul>
                </section>
                <hr>
                <section class="method-area">
                    <p class="method__index">支払い方法</p>
                    <form class="method__form" action="">
                        <div class="select-triangle">&#x25BD;</div>
                        <select name="method_selector" id="method_select" class="select-method">
                            <option value="0" selected disabled>選択してください</option>
                            <option value="1" class="method-conbini">コンビニ払い</option>
                            <option value="2" class="method-card">カード払い</option>
                        </select>
                    </form>
                </section>
                <hr>
                <section class="address-area">
                    <div class="address-header">
                        <p>配送先</p>
                        <a href="/purchase/address/{{ $itemData[ 'id' ] }}">変更する</a>
                    </div>
                    <div class="address-info">
                        <p>〒{{ $profileData['post_number'] }}</p>
                        <p>{{ $profileData['address'] . $profileData['building'] }}</p>
                    </div>
                </section>
                <hr>
            </section>

            <section class="purchase-area">
                <section class="purchase-action-area">
                    <table class="purchase-action-table">
                        <tr class="table-row-price">
                            <td class="purchase-title">商品代金</td>
                            <td class="purchase-price">&yen;{{ number_format( $itemData[ 'price' ] ) }}</td>
                        </tr>
                        <tr>
                            <td class="purchase-title">支払い方法</td>
                            <td class="purchase-method" ><div id="purchase-method-text" >未　定</div></td>
                        </tr>
                    </table>
                    @foreach ($errors->all() as $error)
                    <li class="validatin-error__area">{{$error}}</li>
                    @endforeach
                    <form class="purchase-form" action="/purchase/{{ $itemData[ 'id' ] }}" method="post">
                        @csrf
                        <input type="hidden" name="purchase_method" id="purchase_method">
                        <input type="hidden" name="price" id="price" value="{{ $itemData[ 'price' ] }}">
                        <input type="hidden" name="post_number" id="post_number" value="{{ $profileData['post_number'] }}">
                        <input type="hidden" name="address" id="address" value="{{ $profileData['address'] }}">
                        <input type="hidden" name="building" id="building" value="{{ $profileData['building'] }}">
                        <input type="hidden" name="order_state" id="order_state" value="1">

                        <button type="submit">購入する</button>
                    </form>
                </section>
            </section>
        </div>   
    </main>
    <script>
        var select = document.getElementById('method_select');

        select.onchange = function(){
            document.getElementById('purchase_method').value = select.value
            if(document.getElementById('purchase_method').value == "1") {
                document.getElementById('purchase-method-text').textContent = "コンビニ払い";
            } else {
                document.getElementById('purchase-method-text').textContent = "カード払い";
            };
        }
    </script>
    <script>
        const form = document.querySelector("#search-box");

        async function sendData() {
                
            const keyword = document.getElementById("kw");
            const url = "/?keyword=" + keyword.value;
            location.href = url;
        }

        form.addEventListener("submit", (event) => {
            event.preventDefault();    
            sendData();
        });

    </script>       
@endsection