<!-- dropdown for languages start  -->
<li class="nav-item dropdown pe-2 d-flex align-items-center">
                                <div class="dropdown">
                                    <button class=" dropdown-toggle drop lang_drop_down_butt" type="button" id="dropdownMenuButton2" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fi fi-{{Config::get('languages')[app()->getLocale()]['flag-icon']}} text-sm opacity-10"></i> {{Config::get('languages')[app()->getLocale()]['display'] }}

                                    </button>
                                    <ul class="dropdown-menu " aria-labelledby="dropdownMenuButton2">
                                        @foreach (Config::get('languages') as $lang => $language)
                                        @if ($lang != app()->getLocale())
                                        <li class="d-flex"> <span class="ms-4 fi fi-{{$language['flag-icon']}} text-dark"></span>
                                            <a class="dropdown-item active" href="{{ route('lang.switch', $lang) }}">{{$language['display']}}</a>
                                        </li>
                                        @endif
                                        @endforeach
                                    </ul>
                                </div>
                            </li>
                            <!-- dropdown for languages end  -->