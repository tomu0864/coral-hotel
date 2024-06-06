@php
    $faqs = App\Models\Faq::latest()->take(4)->get();
@endphp

<div class="faq-area pt-100 pb-70 section-bg">
  <div class="container">
      <div class="row align-items-center">
          <div class="col-lg-6">
              <div class="faq-content faq-content-bg2">
                  <div class="section-title">
                      <span class="sp-color">FEEL FREE TO ASK QUESTION</span>
                      <h2>Let's Start a Free of Questions and Get a Quick Support</h2>
                      <p>We are the agency who always gives you a priority on the free of question and you can easily make a question on the bunch.</p>
                  </div>

                  <div class="faq-accordion">
                      <ul class="accordion">
                        @foreach ($faqs as $faq)
                            
                          <li class="accordion-item">
                              <a class="accordion-title" href="javascript:void(0)">
                                  <i class='bx bx-plus'></i>
                                  {{ $faq->question }}
                              </a>

                              <div class="accordion-content">
                                  <p> 
                                    <p class="white-space-pre">{!! nl2br(e($faq->answer)) !!}</p>
                                  </p>
                              </div>
                          </li>

                        @endforeach

                      </ul>
                  </div>
              </div>
          </div>

          <div class="col-lg-6">
              <div class="faq-img-3">
                  <img src="{{ asset('frontend/assets/img/faq/faq-img3.jpg') }}" alt="Images">
              </div>
          </div>
      </div>
  </div>
</div>