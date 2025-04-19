@include('portfolio.navbar')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $portfolio->title }} | Portfolio</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['"DM Sans"', 'sans-serif'],
                    },
                    colors: {
                        primary: {
                            50: '#f0f9ff',
                            100: '#e0f2fe',
                            200: '#bae6fd',
                            300: '#7dd3fc',
                            400: '#38bdf8',
                            500: '#0ea5e9',
                            600: '#0284c7',
                            700: '#0369a1',
                            800: '#075985',
                            900: '#0c4a6e',
                        },
                        dark: {
                            800: '#1e293b',
                            900: '#0f172a',
                        }
                    },
                    animation: {
                        'slide-up': 'slideUp 0.5s ease-out',
                        'tilt': 'tilt 10s infinite linear',
                    },
                    keyframes: {
                        slideUp: {
                            '0%': { transform: 'translateY(20px)', opacity: '0' },
                            '100%': { transform: 'translateY(0)', opacity: '1' },
                        },
                        tilt: {
                            '0%, 100%': { transform: 'rotate(-1deg)' },
                            '50%': { transform: 'rotate(1deg)' },
                        }
                    }
                }
            }
        }
    </script>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;700&display=swap" rel="stylesheet">
</head>
<body class="bg-primary-50 text-dark-900 font-sans antialiased">

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <!-- Hero Section -->
        <header class="mb-16 text-center animate-slide-up">
            
            <h1 class="text-4xl md:text-6xl font-bold text-dark-900 mb-4">
                {{ $portfolio->title }}
            </h1>
            <p class="text-lg md:text-xl text-dark-900/70 max-w-3xl mx-auto">
                {{ $portfolio->summary }}
            </p>
        </header>

        <!-- About Me -->
        <section class="mb-16 animate-slide-up">
    <div class="bg-white rounded-3xl shadow-lg border border-white/20 overflow-hidden backdrop-blur-sm bg-white/80 animate-tilt">
        <div class="p-8 md:p-10">
            <h2 class="text-2xl md:text-3xl font-bold text-dark-900 mb-6 flex items-center">
                <span class="w-8 h-0.5 bg-primary-500 mr-4"></span>
                About Me
            </h2>

            <div class="grid md:grid-cols-2 gap-8 items-center">
                {{-- Image --}}
                @if (!empty($portfolio->aboutMe->image))
                    <div class="text-center">
                        <img 
                            src="{{ asset($portfolio->aboutMe->image) }}" 
                            alt="About Me Image" 
                            class="rounded-xl mx-auto max-h-72 shadow-md"
                        >
                    </div>
                @endif

                {{-- Description --}}
                <div>
                    <p class="text-dark-900/80 text-lg leading-relaxed">
                        {{ $portfolio->aboutMe->description ?? 'No content yet.' }}
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>


        <!-- Skills -->
        <section class="mb-16 animate-slide-up">
            <div class="bg-white rounded-3xl shadow-lg border border-white/20 overflow-hidden backdrop-blur-sm bg-white/80">
                <div class="p-8 md:p-10">
                    <h2 class="text-2xl md:text-3xl font-bold text-dark-900 mb-8 flex items-center">
                        <span class="w-8 h-0.5 bg-primary-500 mr-4"></span>
                        Skills
                    </h2>
                    
                    <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-5 gap-3">
                        @forelse ($portfolio->skills as $skill)
                            <div class="relative group">
                                <div class="bg-white border border-gray-200/80 rounded-lg p-3 flex items-center justify-between transition-all duration-300 group-hover:shadow-md group-hover:border-primary-300 group-hover:bg-primary-50">
                                    <div class="flex items-center">
                                        <div class="h-6 w-6 rounded-full bg-primary-100 flex items-center justify-center mr-3">
                                            <svg class="w-3 h-3 text-primary-600" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                                            </svg>
                                        </div>
                                        <span class="font-medium text-dark-900/90 text-sm">{{ $skill->name }}</span>
                                    </div>
                                </div>
                                <form action="{{ route('skills.destroy', ['portfolioId' => $portfolio->id, 'skill' => $skill->id]) }}" method="POST" 
                                      class="absolute -top-2 -right-2 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="h-5 w-5 rounded-full bg-red-500 flex items-center justify-center shadow-sm hover:bg-red-600 transition-colors">
                                        <svg class="w-2.5 h-2.5 text-white" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        @empty
                            <div class="col-span-full py-8 text-center">
                                <p class="text-dark-900/50">No skills added yet.</p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </section>

        <!-- Projects -->
        <section class="mb-16 animate-slide-up">
            <div class="bg-white rounded-3xl shadow-lg border border-white/20 overflow-hidden backdrop-blur-sm bg-white/80">
                <div class="p-8 md:p-10">
                    <h2 class="text-2xl md:text-3xl font-bold text-dark-900 mb-8 flex items-center">
                        <span class="w-8 h-0.5 bg-primary-500 mr-4"></span>
                        Projects
                    </h2>
                    
                    <div class="grid gap-5 sm:grid-cols-2 lg:grid-cols-3">
                        @forelse ($portfolio->projects as $project)
                            <div class="relative group bg-white border border-gray-200/80 rounded-xl p-5 transition-all duration-300 hover:shadow-md hover:border-primary-300">
                                <form action="{{ route('projects.destroy', ['portfolioId' => $portfolio->id, 'project' => $project->id]) }}" method="POST" 
                                      class="absolute top-2 right-2 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="h-5 w-5 rounded-full bg-red-500 flex items-center justify-center shadow-sm hover:bg-red-600 transition-colors">
                                        <svg class="w-2.5 h-2.5 text-white" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                                        </svg>
                                    </button>
                                </form>
                                <h3 class="text-lg font-semibold text-dark-900 mb-2 group-hover:text-primary-600 transition-colors">{{ $project->title }}</h3>
                                <p class="text-dark-900/70 text-sm">{{ $project->description }}</p>
                            </div>
                        @empty
                            <div class="col-span-full py-8 text-center">
                                <p class="text-dark-900/50">No projects added yet.</p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </section>

        <!-- Education & Experience -->
        <div class="grid md:grid-cols-2 gap-6 mb-16">
            <!-- Education -->
            <section class="animate-slide-up">
                <div class="bg-white rounded-3xl shadow-lg border border-white/20 overflow-hidden backdrop-blur-sm bg-white/80 h-full">
                    <div class="p-8 md:p-10">
                        <h2 class="text-2xl md:text-3xl font-bold text-dark-900 mb-8 flex items-center">
                            <span class="w-8 h-0.5 bg-primary-500 mr-4"></span>
                            Education
                        </h2>
                        
                        <div class="space-y-4">
                            @forelse ($portfolio->education as $edu)
                                <div class="relative group bg-white border border-gray-200/80 rounded-lg p-5 transition-all duration-300 hover:shadow-md hover:border-primary-300">
                                    <form action="{{ route('education.destroy', ['portfolioId' => $portfolio->id, 'education' => $edu->id]) }}" method="POST" 
                                          class="absolute top-2 right-2 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="h-5 w-5 rounded-full bg-red-500 flex items-center justify-center shadow-sm hover:bg-red-600 transition-colors">
                                            <svg class="w-2.5 h-2.5 text-white" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                                            </svg>
                                        </button>
                                    </form>
                                    <h3 class="text-lg font-semibold text-dark-900 mb-1 group-hover:text-primary-600 transition-colors">{{ $edu->degree }}</h3>
                                    <p class="text-dark-900/70 text-sm">{{ $edu->institution }}</p>
                                    <p class="text-xs text-dark-900/50 mt-2">{{ $edu->year }}</p>
                                </div>
                            @empty
                                <div class="py-8 text-center">
                                    <p class="text-dark-900/50">No education details added yet.</p>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </section>

            <!-- Experience -->
            <section class="animate-slide-up">
                <div class="bg-white rounded-3xl shadow-lg border border-white/20 overflow-hidden backdrop-blur-sm bg-white/80 h-full">
                    <div class="p-8 md:p-10">
                        <h2 class="text-2xl md:text-3xl font-bold text-dark-900 mb-8 flex items-center">
                            <span class="w-8 h-0.5 bg-primary-500 mr-4"></span>
                            Experience
                        </h2>
                        
                        <div class="space-y-4">
                            @forelse ($portfolio->experience as $experience)
                                <div class="relative group bg-white border border-gray-200/80 rounded-lg p-5 transition-all duration-300 hover:shadow-md hover:border-primary-300">
                                    <form action="{{ route('experiences.destroy', ['portfolioId' => $portfolio->id, 'experience' => $experience->id]) }}" method="POST" 
                                          class="absolute top-2 right-2 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="h-5 w-5 rounded-full bg-red-500 flex items-center justify-center shadow-sm hover:bg-red-600 transition-colors">
                                            <svg class="w-2.5 h-2.5 text-white" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                                            </svg>
                                        </button>
                                    </form>
                                    <h3 class="text-lg font-semibold text-dark-900 mb-1 group-hover:text-primary-600 transition-colors">{{ $experience->position }}</h3>
                                    <p class="text-dark-900/70 text-sm">{{ $experience->company }}</p>
                                    <p class="text-xs text-dark-900/50 mt-2">{{ $experience->duration }}</p>
                                </div>
                            @empty
                                <div class="py-8 text-center">
                                    <p class="text-dark-900/50">No experience details added yet.</p>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </section>
        </div>

    </div>

</body>
</html>