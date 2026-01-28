<div>
     <!-- start of breadcumb-section -->
        <div class="wpo-breadcumb-area" style="height:600px;background: url('{{ asset('assets/images/luxproperty.jpg') }}') no-repeat center center/cover !important;">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="wpo-breadcumb-wrap">
                            <h2>Luxury Properties</h2>
                            <ul>
                                <li><a href="/">Home</a></li>
                                <li><span>Luxury Properties</span></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end of wpo-breadcumb-section-->
          <!-- end of wpo-breadcumb-section-->
        <div class="wpo-destination-area pt-120">
            <div class="container">
                <div class="destination-wrap">
                    <div class="row">

                        <!--Foreach-->
                        @foreach ($assets as $item)
                         <div class="col-lg-4 col-md-6 col-12">
                          <a href="/details/{{encrypt($item->id)}}" style="clearfix:clear">
                           
                                <div class="destination-item">
                                    @php
                                        $photos = json_decode($item->asset_photos, true);
                                        $firstImage = $photos[0] ?? 'default.jpg';
                                    @endphp

                                    <div class="destination-img">
                                        <img src="{{ asset($firstImage) }}" alt="Destination Image" style="height:250px">
                                    </div>
                                    <div class="destination-content">
                                        <h2>{{$item->asset_name}}</h2>
                                        <div class="destination-bottom">
                                            <p>${{number_format($item->asset_price)}} Cost</p>
                                            <div class="destination-bottom-right">
                                                <ul>
                                                    <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                                    <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                                    <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                                    <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                                    <li><span><i class="fa fa-star" aria-hidden="true"></i></span></li>
                                                </ul>
                                                <small>4.5</small>
                                            </div>
                                        </div>
                                    </div>
                                  </div>
                                </a>
                              </div>
                            
                         @endforeach  
                    </div>
                </div>
            </div>
        </div>
</div>
