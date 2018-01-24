<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
    {{-- <link href="{{ mix('css/vendor.css') }}" rel="stylesheet"> --}}

    @yield('header_styles')
</head>
<body class="px-8">
    <div class="flex pt-6 pb-2">
        <div class="w-1/5 px-4">
            <h1 class="text-gold">{{ config('app.name') }}</h1>
        </div>
        <div class="w-full px-4">
            <div class="flex">
                <div class="w-full">
                    <div class="w-3/5">
                        <div class="relative">
                            <i class="fa fa-search absolute text-grey-dark mt-2 ml-3"></i>
                            <input class="shadow border rounded w-full px-3 py-2 pl-8" placeholder="Search by lead name or email address" />
                        </div>
                    </div>
                </div>
                <div class="w-1/4">
                    <div class="flex justify-end">
                        <ul class="list-reset flex items-center">
                            <li class="mx-2">
                                <a href="#" class="text-grey hover:text-grey-darker">
                                    <i class="fa fa-bullhorn text-xl"></i>
                                </a>
                            </li>                        
                            <li class="mx-2">
                                <a href="#" class="text-grey hover:text-grey-darker">
                                    <i class="fa fa-book text-xl"></i>
                                </a>
                            </li>                        
                            <li class="mx-2">
                                <a href="#" class="text-grey hover:text-grey-darker">
                                    <i class="fa fa-bell text-xl"></i>
                                </a>
                            </li>
                            <li class="ml-2">
                                <img src="/images/avatar.jpeg" alt="" title="" class="rounded-full w-8 h-8 mt-1 shadow" />
                            </li>
                        </ul>
                    </div>
                </div>                
            </div>
        </div>
    </div>
    <div class="flex">
        <div class="w-1/5 px-4 py-4 mt-3">
            <div class="mb-8">
                <ul class="list-reset">
                    <li class="mb-3">
                        <a href="{{ route('admin.index') }}" class="no-underline text-grey-darker hover:text-gold">
                            <i class="fa fa-dashboard mr-1"></i> Dashboard
                        </a>
                    </li>
                </ul>
            </div>
            <div class="mb-8">
                <p class="mb-4 text-grey uppercase tracking-wide font-bold text-xs">
                    Database
                </p>
                <ul class="list-reset">
                    <li class="mb-3">
                        <a href="{{ route('admin.contacts.index') }}" class="no-underline text-grey-darker hover:text-gold">
                            <i class="fa fa-user-circle-o mr-1"></i> Contacts
                        </a>
                        <ul class="list-reset mt-3">
                            <li class="mb-2">
                                <a href="{{ route('admin.leads.index', 'buyer-lead-residential') }}" class="no-underline text-grey-darker hover:text-gold">
                                    Buyer LEAD - Residential
                                </a>
                            </li>
                            <li class="mb-2">
                                <a href="{{ route('admin.leads.index', 'buyer-lead-commercial') }}" class="no-underline text-grey-darker hover:text-gold">
                                    Buyer LEAD - Commercial
                                </a>
                            </li>
                            <li class="mb-2">
                                <a href="{{ route('admin.leads.index', 'landlord-lead-residential') }}" class="no-underline text-grey-darker hover:text-gold">
                                    Landlord LEAD - Residential
                                </a>
                            </li> 
                            <li class="mb-2">
                                <a href="{{ route('admin.leads.index', 'landlord-lead-commercial') }}" class="no-underline text-grey-darker hover:text-gold">
                                    Landlord LEAD - Commercial
                                </a>
                            </li>                                                                                    
                            <li class="mb-2">
                                <a href="{{ route('admin.leads.index', 'tenant-lead-residential') }}" class="no-underline text-grey-darker hover:text-gold">
                                    Tenant LEAD - Residential
                                </a>
                            </li>

                            <li class="mb-2">
                                <a href="{{ route('admin.leads.index', 'tenant-lead-commercial') }}" class="no-underline text-grey-darker hover:text-gold">
                                    Tenant LEAD - Commercial
                                </a>
                            </li>

                            <li class="mb-2">
                                <a href="{{ route('admin.leads.index', 'no-answer') }}" class="no-underline text-grey-darker hover:text-gold">
                                    No Answer
                                </a>
                            </li> 

                            <li class="mb-2">
                                <a href="{{ route('admin.leads.index', 'wrong-number') }}" class="no-underline text-grey-darker hover:text-gold">
                                    Wrong Number / Out of Service
                                </a>
                            </li>

                            <li class="mb-2">
                                <a href="{{ route('admin.leads.index', 'busy-line') }}" class="no-underline text-grey-darker hover:text-gold">
                                    Busy Line
                                </a>
                            </li> 

                            <li class="mb-2">
                                <a href="{{ route('admin.leads.index', 'switched-off') }}" class="no-underline text-grey-darker hover:text-gold">
                                    Switched OFF
                                </a>
                            </li> 

                            <li class="mb-2">
                                <a href="{{ route('admin.leads.index', 'callback-request') }}" class="no-underline text-grey-darker hover:text-gold">
                                    Callback request
                                </a>
                            </li>

                            <li class="mb-2">
                                <a href="{{ route('admin.leads.index', 'hangup-cancelled') }}" class="no-underline text-grey-darker hover:text-gold">
                                    Hangup / Cancelled
                                </a>
                            </li>

                            <li class="mb-2">
                                <a href="{{ route('admin.leads.index', 'follow-up') }}" class="no-underline text-grey-darker hover:text-gold">
                                    Follow up
                                </a>
                            </li>     
                            <li class="mb-2">
                                <a href="{{ route('admin.leads.index', 'do-not-call-dnd') }}" class="no-underline text-grey-darker hover:text-gold">
                                    DO NOT CALL - DND
                                </a>
                            </li>
                            <li class="mb-2">
                                <a href="{{ route('admin.leads.index', 'not-interested-now') }}" class="no-underline text-grey-darker hover:text-gold">
                                    Not interested NOW
                                </a>
                            </li> 

                            <li class="mb-2">
                                <a href="{{ route('admin.leads.index', 'not-interested-at-all') }}" class="no-underline text-grey-darker hover:text-gold">
                                    Not interested AT ALL
                                </a>
                            </li>                             
                        </ul>                        
                    </li>
                </ul>
            </div>
            <div class="mb-8">
                <p class="mb-4 text-grey uppercase tracking-wide font-bold text-xs">
                    Properties
                </p>
                <ul class="list-reset">
                    <li class="mb-3">
                        <a href="{{ route('admin.properties.index') }}" class="no-underline text-grey-darker hover:text-gold">
                            <i class="fa fa-building mr-1"></i> Listings
                        </a>
                    </li>  
                    <li class="mb-3">
                        <a href="#" class="no-underline text-grey hover:text-gold">
                            <i class="fa fa-building mr-1"></i> Developers
                        </a>
                    </li>                                                           
                </ul>
            </div> 
            <div class="mb-8">
                <p class="mb-4 text-grey uppercase tracking-wide font-bold text-xs">
                    Locations
                </p>
                <ul class="list-reset">
                    <li class="mb-3">
                        <a href="#" class="no-underline text-grey hover:text-gold">
                            <i class="fa fa-globe mr-1"></i> Countries
                        </a>
                    </li>  
                    <li class="mb-3">
                        <a href="#" class="no-underline text-grey hover:text-gold">
                            <i class="fa fa-building mr-1"></i> Cities
                        </a>
                    </li> 
                    <li class="mb-3">
                        <a href="#" class="no-underline text-grey hover:text-gold">
                            <i class="fa fa-building mr-1"></i> Communities
                        </a>
                    </li>                                                                               
                </ul>
            </div>                        
            <div class="mb-8">
                <p class="mb-4 text-grey uppercase tracking-wide font-bold text-xs">
                    Statistics
                </p>
                <ul class="list-reset">
                    <li class="mb-3">
                        <a href="{{ route('admin.contacts.index') }}" class="no-underline text-grey hover:text-gold">
                            <i class="fa fa-line-chart mr-1"></i> Statistics
                        </a>
                    </li>
                    <li class="mb-3">
                        <a href="{{ route('admin.contacts.index') }}" class="no-underline text-grey hover:text-gold">
                            <i class="fa fa-file-archive-o mr-1"></i> Archive
                        </a>
                    </li>                    
                </ul>
            </div>  
            <div class="mb-8">
                <ul class="list-reset">
                    <li class="mb-3">
                        <a href="{{ route('logout') }}" class="no-underline text-red hover:text-red-dark"
                            onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();"
                        >
                            <i class="fa fa-power-off mr-1"></i> Logout
                        </a>
                        
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                        </form>                        
                    </li>
                </ul>
            </div>                      
        </div>
        <div class="w-full px-4 py-4">
            @yield('content')
        </div>
    </div>

    @include('footer')
    <script src="{{ mix('js/app.js') }}"></script>
    @yield('footer_scripts')
</body>
</html>
