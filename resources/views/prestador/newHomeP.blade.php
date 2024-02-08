@extends('layouts/prestador-layout')

@section('breadcrumb')
    <nav aria-label="breadcrumb" class="-intro-x hidden xl:flex">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('homeP')}}">Prestador</a></li>
            <li class="breadcrumb-item active" aria-current="page">Home</li>
        </ol>
    </nav>
@endsection

@section('subcontent')

    <div class="col-span-12 2xl:col-span-9">
        <div class="intro-y block sm:flex items-center h-10">
            <h2 class="text-lg font-medium truncate mr-5 text-align center">Seguimiento de horas</h2>
        </div>
        <!-- Floating Icon -->
        <div id="floating-icon" style="position: fixed; bottom: 20px; right: 20px; cursor: pointer; z-index: 1000;">
            <!-- Replace the following SVG code with your actual icon SVG -->
            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 512 512" width="100" height="100" preserveAspectRatio="xMidYMid meet" style="width: 100%; height: 100%; transform: translate3d(0px, 0px, 0px); content-visibility: visible;" id="Mentoring Arrow"><defs><clipPath id="__lottie_element_30351"><rect width="512" height="512" x="0" y="0"/></clipPath></defs><g clip-path="url(#__lottie_element_30351)"><g transform="matrix(0.8600000143051147,0,0,0.8600000143051147,70.9700927734375,211.97183227539062)" opacity="1" style="display: block;"><g opacity="1" transform="matrix(1,0,0,1,143.3800048828125,179.96600341796875)"><path fill="rgb(239,196,24)" fill-opacity="1" d=" M-23.270000457763672,-54.191001892089844 C-23.270000457763672,-54.191001892089844 121.96700286865234,-74.9260025024414 121.96700286865234,-74.9260025024414 C131.3560028076172,-76.28399658203125 140.2469940185547,-70.30799865722656 142.53399658203125,-61.10200119018555 C142.89999389648438,-59.62200164794922 143.0989990234375,-58.10499954223633 143.1300048828125,-56.58100128173828 C143.09800720214844,-48.11399841308594 137.34100341796875,-40.742000579833984 129.13499450683594,-38.65999984741211 C129.13499450683594,-38.65999984741211 23.32200050354004,-12.24899959564209 23.32200050354004,-12.24899959564209 C15.800000190734863,-10.36299991607666 10.52400016784668,-3.6040000915527344 10.522000312805176,4.1519999504089355 C10.522000312805176,4.1519999504089355 10.522000312805176,76.28399658203125 10.522000312805176,76.28399658203125 C10.522000312805176,76.28399658203125 -143.07699584960938,76.28399658203125 -143.07699584960938,76.28399658203125 C-143.07699584960938,76.28399658203125 -143.07699584960938,8.017000198364258 -143.07699584960938,8.017000198364258 C-143.1300048828125,-23.160999298095703 -119.1259994506836,-49.099998474121094 -88.03800201416016,-51.459999084472656 C-88.03800201416016,-51.459999084472656 -23.270000457763672,-54.191001892089844 -23.270000457763672,-54.191001892089844z"/></g><g opacity="1" transform="matrix(1,0,0,1,85.63600158691406,68.51699829101562)"><path fill="rgb(252,214,172)" fill-opacity="1" d=" M59.73400115966797,-8.534000396728516 C59.73400115966797,-8.534000396728516 59.73400115966797,8.532999992370605 59.73400115966797,8.532999992370605 C59.73400115966797,41.52399826049805 32.9900016784668,68.26699829101562 0.0010000000474974513,68.26699829101562 C-32.98899841308594,68.26699829101562 -59.73400115966797,41.52399826049805 -59.73400115966797,8.532999992370605 C-59.73400115966797,8.532999992370605 -59.73400115966797,-8.534000396728516 -59.73400115966797,-8.534000396728516 C-59.73400115966797,-41.52399826049805 -32.98899841308594,-68.26699829101562 0.0010000000474974513,-68.26699829101562 C32.9900016784668,-68.26699829101562 59.73400115966797,-41.52399826049805 59.73400115966797,-8.534000396728516z"/></g></g><g transform="matrix(0.8427081108093262,0,0,0.8427081108093262,205.5028076171875,162.71620178222656)" opacity="1" style="display: block;"><g opacity="1" transform="matrix(1,0,0,1,94.11599731445312,88.65599822998047)"><path fill="rgb(103,184,204)" fill-opacity="1" d=" M-85.33300018310547,39.59400177001953 C-85.33300018310547,39.59400177001953 -51.20100021362305,39.59400177001953 -51.20100021362305,39.59400177001953 C-51.20100021362305,39.59400177001953 -51.20100021362305,88.40599822998047 -51.20100021362305,88.40599822998047 C-51.20100021362305,88.40599822998047 -38.39899826049805,86.52899932861328 -38.39899826049805,86.52899932861328 C-38.39899826049805,86.52899932861328 8.532999992370605,39.59400177001953 8.532999992370605,39.59400177001953 C8.532999992370605,39.59400177001953 76.8010025024414,39.59400177001953 76.8010025024414,39.59400177001953 C86.21499633789062,39.566001892089844 93.83899688720703,31.94300079345703 93.86699676513672,22.52899932861328 C93.86699676513672,22.52899932861328 93.86699676513672,-71.33799743652344 93.86699676513672,-71.33799743652344 C93.83899688720703,-80.75199890136719 86.21499633789062,-88.37799835205078 76.8010025024414,-88.40599822998047 C76.8010025024414,-88.40599822998047 -76.8010025024414,-88.40599822998047 -76.8010025024414,-88.40599822998047 C-86.21399688720703,-88.37799835205078 -93.83899688720703,-80.75199890136719 -93.86699676513672,-71.33799743652344 C-93.86699676513672,-71.33799743652344 -93.86699676513672,0.34200000762939453 -93.86699676513672,0.34200000762939453 C-93.86699676513672,0.34200000762939453 -85.33300018310547,39.59400177001953 -85.33300018310547,39.59400177001953z"/></g></g><g transform="matrix(0,0,0,0,235.60000610351562,192.1999969482422)" opacity="1" style="display: block;"><g opacity="1" transform="matrix(1,0,0,1,59.983001708984375,8.784000396728516)"><path fill="rgb(62,92,108)" fill-opacity="1" d=" M51.20000076293945,8.532999992370605 C51.20000076293945,8.532999992370605 -51.20000076293945,8.532999992370605 -51.20000076293945,8.532999992370605 C-55.91299819946289,8.532999992370605 -59.733001708984375,4.7129998207092285 -59.733001708984375,0.0010000000474974513 C-59.733001708984375,-4.711999893188477 -55.91299819946289,-8.532999992370605 -51.20000076293945,-8.532999992370605 C-51.20000076293945,-8.532999992370605 51.20000076293945,-8.532999992370605 51.20000076293945,-8.532999992370605 C55.91299819946289,-8.532999992370605 59.733001708984375,-4.711999893188477 59.733001708984375,0.0010000000474974513 C59.733001708984375,4.7129998207092285 55.91299819946289,8.532999992370605 51.20000076293945,8.532999992370605z"/></g></g><g transform="matrix(0.8600000143051147,0,0,0.8600000143051147,42.11954116821289,42.026611328125)" opacity="1" style="display: block;"><g opacity="1" transform="matrix(1,0,0,1,248.17100524902344,248.22000122070312)"><path fill="rgb(230,75,59)" fill-opacity="1" d=" M247.92100524902344,-50.69599914550781 C247.92100524902344,-50.69599914550781 247.92100524902344,77.30400085449219 247.92100524902344,77.30400085449219 C247.92100524902344,171.56100463867188 171.50999450683594,247.9709930419922 77.25299835205078,247.9709930419922 C77.25299835205078,247.9709930419922 -221.41299438476562,247.9709930419922 -221.41299438476562,247.9709930419922 C-235.552001953125,247.9709930419922 -247.01300048828125,236.50900268554688 -247.01300048828125,222.3699951171875 C-247.01300048828125,208.23300170898438 -235.552001953125,196.77000427246094 -221.41299438476562,196.77000427246094 C-221.41299438476562,196.77000427246094 77.25299835205078,196.77000427246094 77.25299835205078,196.77000427246094 C143.23199462890625,196.77000427246094 196.72000122070312,143.2830047607422 196.72000122070312,77.30400085449219 C196.72000122070312,77.30400085449219 196.72000122070312,-50.69599914550781 196.72000122070312,-50.69599914550781 C196.72000122070312,-116.67500305175781 143.23199462890625,-170.16200256347656 77.25299835205078,-170.16200256347656 C77.25299835205078,-170.16200256347656 -178.74600219726562,-170.16200256347656 -178.74600219726562,-170.16200256347656 C-178.74600219726562,-170.16200256347656 -178.74600219726562,-152.24200439453125 -178.74600219726562,-152.24200439453125 C-178.95899963378906,-147.77499389648438 -182.7530059814453,-144.3260040283203 -187.2209930419922,-144.5399932861328 C-188.9980010986328,-144.62399291992188 -190.69900512695312,-145.29200744628906 -192.0590057373047,-146.44000244140625 C-192.0590057373047,-146.44000244140625 -244.2830047607422,-189.9600067138672 -244.2830047607422,-189.9600067138672 C-247.48800659179688,-192.62899780273438 -247.9199981689453,-197.39100646972656 -245.25100708007812,-200.5959930419922 C-244.95799255371094,-200.94700622558594 -244.63499450683594,-201.27200317382812 -244.2830047607422,-201.56500244140625 C-244.2830047607422,-201.56500244140625 -192.0590057373047,-245.0850067138672 -192.0590057373047,-245.0850067138672 C-188.64100646972656,-247.97000122070312 -183.531005859375,-247.53700256347656 -180.64599609375,-244.11900329589844 C-179.4980010986328,-242.75999450683594 -178.8300018310547,-241.05999755859375 -178.74600219726562,-239.28199768066406 C-178.74600219726562,-239.28199768066406 -178.74600219726562,-221.36300659179688 -178.74600219726562,-221.36300659179688 C-178.74600219726562,-221.36300659179688 77.25299835205078,-221.36300659179688 77.25299835205078,-221.36300659179688 C171.39500427246094,-221.08599853515625 247.64500427246094,-144.83799743652344 247.92100524902344,-50.69599914550781z"/></g></g><g transform="matrix(0,0,0,0,234.5330047607422,231.86700439453125)" opacity="1" style="display: block;"><g opacity="1" transform="matrix(1,0,0,1,42.91600036621094,8.782999992370605)"><path fill="rgb(62,92,108)" fill-opacity="1" d=" M34.13399887084961,8.532999992370605 C34.13399887084961,8.532999992370605 -34.132999420166016,8.532999992370605 -34.132999420166016,8.532999992370605 C-38.84600067138672,8.532999992370605 -42.66699981689453,4.7129998207092285 -42.66699981689453,0 C-42.66699981689453,-4.7129998207092285 -38.84600067138672,-8.532999992370605 -34.132999420166016,-8.532999992370605 C-34.132999420166016,-8.532999992370605 34.13399887084961,-8.532999992370605 34.13399887084961,-8.532999992370605 C38.84700012207031,-8.532999992370605 42.66699981689453,-4.7129998207092285 42.66699981689453,0 C42.66699981689453,4.7129998207092285 38.84700012207031,8.532999992370605 34.13399887084961,8.532999992370605z"/></g></g></g></svg>
        </div>
        <div class="grid grid-cols-12">

            <!-- BEGIN: Reporte Horas Generales -->
            <div class="col-span-12 mt-6">     
                <div class="intro-y report-box mt-12 sm:mt-4">
                    <div class="box py-0 xl:py-5 grid grid-cols-12 gap-0 divide-y xl:divide-y-0 divide-x divide-dashed divide-slate-200 dark:divide-white/5">

                        <div class="report-box__item py-5 xl:py-0 px-5 col-span-12 sm:col-span-6 xl:col-span-3">
                            <div class="report-box__content">
                                <div class="flex">
                                    <div class="report-box__item__icon text-primary bg-primary/20 border border-success/20 border-primary/20 flex items-center justify-center rounded-full">
                                        <i data-lucide="pie-chart"></i>
                                    </div>
                                </div>
                                <div class="text-2xl font-medium leading-7 mt-6">{{$horasTotales}}</div>
                                <div class="text-slate-500 mt-1">TOTAL DE HORAS</div>
                            </div>
                        </div>
                        <div class="report-box__item py-5 xl:py-0 px-5 sm:!border-t-0 col-span-12 sm:col-span-6 xl:col-span-3">
                            <div class="report-box__content">
                                <div class="flex">
                                    <div class="report-box__item__icon text-success bg-success/20 border flex items-center justify-center rounded-full">                                           
                                        <i data-lucide="pie-chart"></i>
                                    </div>
                                </div>
                                <div class="text-2xl font-medium leading-7 mt-6">{{$horasAutorizadas}}</div>
                                <div class="text-slate-500 mt-1">HORAS AUTORIZADAS</div>
                            </div>
                        </div>
                        <div class="report-box__item py-5 xl:py-0 px-5 col-span-12 sm:col-span-6 xl:col-span-3">
                            <div class="report-box__content">
                                <div class="flex">
                                    <div class="report-box__item__icon text-warning bg-warning/20 border border-warning/20 flex items-center justify-center rounded-full">
                                        <i data-lucide="pie-chart"></i>
                                    </div>
                                </div>
                                <div class="text-2xl font-medium leading-7 mt-6">{{$horasPendientes}}</div>
                                <div class="text-slate-500 mt-1">HORAS PENDIENTES POR AUTORIZAR</div>
                            </div>
                        </div>
                        <div class="report-box__item py-5 xl:py-0 px-5 col-span-12 sm:col-span-6 xl:col-span-3">
                            <div class="report-box__content">
                                <div class="flex">
                                    <div class="report-box__item__icon text-pending bg-pending/20 border border-pending/20 flex items-center justify-center rounded-full"> 
                                        <i data-lucide="pie-chart"></i>
                                    </div>
                            </div>
                            <div class="text-2xl font-medium leading-7 mt-6">{{$horasRestantes}}</div>
                            <div class="text-slate-500 mt-1 text-align center">HORAS RESTANTES</div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END: Reporte 1 -->

            <!-- BEGIN: Leaderboard -->
            <div class="xl:px-6 mt-2.5">
                <div class="intro-y flex items-center mt-8">
                    <h2 class="text-lg font-medium mr-auto">
                        TORNEO: MEJORES PRESTADORES DE SERVICIO
                    </h2>
                </div>
            </div>

            <div class="p-5" id="basic-table">
                <div class="overflow-x-auto">
                    <table class="table">
                        <thead>
                            <tr>
                                <th class="whitespace-nowrap">#</th>
                                <th class="whitespace-nowrap">Prestador</th>
                                <th class="whitespace-nowrap">Experiencia</th>
                                <th class="whitespace-nowrap">Rango</th>

                            </tr>
                        </thead>

                        <tbody>

                            <?php $bandera = false;?>
                                
                            @foreach ( $leaderBoard as $top)
                                <?php $imagen = DB::select("select imagen_perfil from users where codigo=$top->codigo")?>
                                <tr>
                                    @if ($top->codigo == Auth::user()->codigo)
                                        <?php $bandera = true; ?>
                                        <td><strong><p style="color: #0023FF;">{{$top->Posicion}}</p></strong></td>
                                        
                                        <td>
                                            <div class="w-10 h-10 image-fit">
                                            @if (Auth::user()->imagen_perfil)
                                                <img class="rounded-full border-2 border-slate-100 border-opacity-10 shadow-lg" 
                                                src="{{asset('storage/userImg/'.Auth::user()->imagen_perfil)}}" 
                                                width="40" height="40" alt="">
                                            @else
                                                <img class="rounded-full border-2 border-slate-100 border-opacity-10 shadow-lg" 
                                                src="{{asset('storage/userImg/default-profile-image.png')}}"
                                                width="40" height="40" alt="">
                                            @endif
                                            </div>
                                            <strong><p style="color: #0023FF"> {{$top->Inventor}}</p></strong></td>
                                        <td><strong><p style="color: #0023FF">{{$top->experiencia}}</p></strong></td>
                                        <td><img src="{{asset('build/assets/'.$usuarioMedalla->ruta)}}"  width="40" height="80" alt=""></td>
                                                
                                    @else
                                        
                                        <td>{{$top->Posicion}}</td>
                                        <td>
                                            <div class="w-10 h-10 image-fit">
                                            @if(!$imagen[0]->imagen_perfil)
                                                <img class="rounded-full border-2 border-slate-100 border-opacity-10 shadow-lg" 
                                                src="{{asset('storage/userImg/default-profile-image.png')}}" 
                                                width="40" height="40" alt="">    
                                            @else
                                                <img class="rounded-full border-2 border-slate-100 border-opacity-10 shadow-lg" 
                                                src="{{asset('storage/userImg/'.$imagen[0]->imagen_perfil)}}" 
                                                width="40" height="40" alt="">
                                            @endif
                                            </div>
                                            {{$top->Inventor}}</td>
                                        <td>{{$top->experiencia}}</td>
                                        <td><img src="{{asset('build/assets/'.$top->ruta)}}"  width="40" height="80" alt=""></td>
                                    @endif
                                    
                                </tr>
                            @endforeach
                            @if (!$bandera)
                                <tr>
                                    <td> <p style="color: #0023FF"><strong>{{$posicionUsuario[0]->position}} </strong> </p></td>
                                    <td>
                                    <div class="w-10 h-10 image-fit">
                                    @if(!isset(Auth::user()->imagen_perfil))
                                        <img class="rounded-full border-2 border-slate-100 border-opacity-10 shadow-lg" alt="{{Auth::user()->name.' '.Auth::user()->apellido}}" src="{{asset('storage/userImg/default-profile-image.png')}}">
                                    @else
                                        <img class="rounded-full border-2 border-slate-100 border-opacity-10 shadow-lg" 
                                        src="{{asset('storage/userImg/'.Auth::user()->imagen_perfil)}}" 
                                        width="40" height="40" alt="">                                
                                    @endif
                                    </div>    
                                    <p style="color: #0023FF"><strong> {{$posicionUsuario[0]->Nombre}}</strong></p> </td>
                                    <td> <p style="color: #0023FF"><strong>{{$posicionUsuario[0]->experiencia}}</strong></p> </td>
                                    <td><img src="{{asset('build/assets/'.$usuarioMedalla->ruta)}}" width="40" height="80"alt=""></td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- END: Leaderboard-->
    </div>
    <style>
        #floating-icon {
            position: fixed;
            bottom: 20px;
            right: 20px;
            cursor: pointer;
            z-index: 1000;
            transition: background-color 0.3s ease-out;
        }

        #floating-icon:hover {
            background-color: rgba(0, 0, 0, 0.1);
        }

        .chat-bubble {
            display: none;
            position: fixed;
            bottom: 80px;
            right: 20px;
            width: 300px;
            height: 400px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
            z-index: 1000;
            overflow: hidden;
        }

        #chat-content {
            padding: 10px;
            height: calc(100% - 40px);
            overflow-y: auto;
        }
    </style>
    <!-- JavaScript for handling clicks on the floating button -->
    <!-- Floating Icon -->
    <div id="floating-icon" onclick="toggleChatBubble()" style="position: fixed; bottom: 20px; right: 20px; cursor: pointer; z-index: 1000;">
        <!-- Replace the following SVG code with your actual icon SVG -->
        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 512 512" width="100" height="100" preserveAspectRatio="xMidYMid meet" style="width: 100%; height: 100%; transform: translate3d(0px, 0px, 0px); content-visibility: visible;" id="Mentoring Arrow">
            <!-- Icon SVG code... -->
        </svg>
    </div>

    <!-- Chat Bubble -->
    <div id="chat-bubble" class="chat-bubble">
        <div id="chat-content">
            <!-- Chat content goes here... -->
            <div id="chat-messages"></div>
            <form id="chat-form">
                <input type="text" id="user-input" placeholder="Type your message...">
                <button type="button" onclick="sendMessage()">Send</button>
            </form>
        </div>
    </div>

    <script>
        function toggleChatBubble() {
            const chatBubble = document.getElementById('chat-bubble');
            chatBubble.style.display = chatBubble.style.display === 'none' ? 'block' : 'none';
        }

        function sendMessage() {
            const userInput = document.getElementById('user-input').value;
            const chatMessages = document.getElementById('chat-messages');

            // Display user message
            chatMessages.innerHTML += `<div>User: ${userInput}</div>`;

            // Send user message to server (you need to implement this part)
            sendUserMessageToServer(userInput);

            // Clear user input
            document.getElementById('user-input').value = '';
        }

        function receiveBotResponse(response) {
            const chatMessages = document.getElementById('chat-messages');
            // Display bot response
            chatMessages.innerHTML += `<div>Bot: ${response}</div>`;
        }

        function sendUserMessageToServer(userInput) {
            fetch('/chatbot/send-message', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({
                    user_input: userInput,
                }),
            })
            .then(response => response.json())
            .then(data => {
                // Handle the bot response from the server
                receiveBotResponse(data.bot_response);
            })
            .catch(error => {
                console.error('Error sending user input to the server:', error);
            });
        }
    </script>

@endsection

