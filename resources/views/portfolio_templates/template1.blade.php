@include("portfolio.navbar")
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
                        sans: ['Inter', 'sans-serif'],
                    },
                    animation: {
                        'fade-in': 'fadeIn 0.5s ease-in-out',
                        'float': 'float 3s ease-in-out infinite',
                    },
                    keyframes: {
                        fadeIn: {
                            '0%': { opacity: '0' },
                            '100%': { opacity: '1' },
                        },
                        float: {
                            '0%, 100%': { transform: 'translateY(0)' },
                            '50%': { transform: 'translateY(-5px)' },
                        }
                    }
                }
            }
        }
    </script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>
<body class="bg-gradient-to-br from-gray-50 to-gray-100 font-sans text-gray-800 antialiased">

    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <!-- Hero Section -->
        <header class="mb-16 text-center animate-fade-in">
            <h1 class="text-5xl md:text-6xl font-bold bg-clip-text text-transparent bg-gradient-to-r from-blue-600 to-purple-600 mb-4">
                {{ $portfolio->title }}
            </h1>
            <p class="text-xl md:text-2xl text-gray-600 max-w-3xl mx-auto">
                {{ $portfolio->summary }}
            </p>
        </header>

        <!-- About Me -->
        <section class="mb-16 animate-fade-in">
    <div class="bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-100 transform transition-all hover:shadow-2xl">
        <div class="p-8 md:p-10">
            <div class="flex items-center mb-6">
                <div class="h-12 w-1 bg-gradient-to-b from-blue-500 to-purple-500 rounded-full mr-4"></div>
                <h2 class="text-3xl font-bold text-gray-900">About Me</h2>
            </div>

            {{-- Show image if it exists --}}
            @if (!empty($portfolio->aboutMe->image))
                <div class="mb-6 text-center">
                    <img 
                        src="{{ asset($portfolio->aboutMe->image) }}" 
                        alt="About Me Image" 
                        class="rounded-xl mx-auto max-h-64 shadow-md"
                    >
                </div>
            @endif

            {{-- Show description --}}
            <p class="text-gray-600 text-lg leading-relaxed">
                {{ $portfolio->aboutMe->description ?? 'No content yet.' }}
            </p>
        </div>
    </div>
</section>


        <!-- Skills -->
        <section class="mb-16 animate-fade-in">
            <div class="bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-100">
                <div class="p-8 md:p-10">
                    <div class="flex items-center mb-8">
                        <div class="h-12 w-1 bg-gradient-to-b from-green-500 to-teal-500 rounded-full mr-4"></div>
                        <h2 class="text-3xl font-bold text-gray-900">Skills</h2>
                    </div>
                    
                    <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-4">
                        @forelse ($portfolio->skills as $skill)
                            <div class="relative group">
                                <div class="bg-gradient-to-br from-green-50 to-white border border-green-100 rounded-xl p-4 flex items-center justify-between transition-all duration-300 group-hover:shadow-md group-hover:border-green-200">
                                    <div class="flex items-center">
                                        <div class="h-8 w-8 rounded-full bg-green-100 flex items-center justify-center mr-3">
                                            <svg class="w-4 h-4 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                                            </svg>
                                        </div>
                                        <span class="font-medium text-gray-700">{{ $skill->name }}</span>
                                    </div>
                                </div>
                                <form action="{{ route('skills.destroy', ['portfolioId' => $portfolio->id, 'skill' => $skill->id]) }}" method="POST" 
                                      class="absolute -top-2 -right-2 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="h-6 w-6 rounded-full bg-red-500 flex items-center justify-center shadow-sm hover:bg-red-600 transition-colors">
                                        <svg class="w-3 h-3 text-white" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        @empty
                            <div class="col-span-full py-8 text-center">
                                <p class="text-gray-500">No skills added yet.</p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </section>

        <!-- Projects -->
        <section class="mb-16 animate-fade-in">
            <div class="bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-100">
                <div class="p-8 md:p-10">
                    <div class="flex items-center mb-8">
                        <div class="h-12 w-1 bg-gradient-to-b from-purple-500 to-indigo-500 rounded-full mr-4"></div>
                        <h2 class="text-3xl font-bold text-gray-900">Projects</h2>
                    </div>
                    
                    <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
                        @forelse ($portfolio->projects as $project)
                            <div class="relative group bg-gradient-to-br from-purple-50 to-white border border-purple-100 rounded-xl p-6 transition-all duration-300 hover:shadow-md hover:border-purple-200 animate-float">
                                <form action="{{ route('projects.destroy', ['portfolioId' => $portfolio->id, 'project' => $project->id]) }}" method="POST" 
                                      class="absolute top-3 right-3 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="h-6 w-6 rounded-full bg-red-500 flex items-center justify-center shadow-sm hover:bg-red-600 transition-colors">
                                        <svg class="w-3 h-3 text-white" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                                        </svg>
                                    </button>
                                </form>
                                <h3 class="text-xl font-semibold text-gray-800 mb-2 group-hover:text-purple-600 transition-colors">{{ $project->title }}</h3>
                                <p class="text-gray-600">{{ $project->description }}</p>
                            </div>
                        @empty
                            <div class="col-span-full py-8 text-center">
                                <p class="text-gray-500">No projects added yet.</p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </section>

        <!-- Education & Experience -->
        <div class="grid md:grid-cols-2 gap-8 mb-16">
            <!-- Education -->
            <section class="animate-fade-in">
                <div class="bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-100 h-full">
                    <div class="p-8 md:p-10">
                        <div class="flex items-center mb-8">
                            <div class="h-12 w-1 bg-gradient-to-b from-yellow-500 to-amber-500 rounded-full mr-4"></div>
                            <h2 class="text-3xl font-bold text-gray-900">Education</h2>
                        </div>
                        
                        <div class="space-y-6">
                            @forelse ($portfolio->education as $edu)
                                <div class="relative group bg-gradient-to-br from-amber-50 to-white border border-amber-100 rounded-xl p-6 transition-all duration-300 hover:shadow-md hover:border-amber-200">
                                    <form action="{{ route('education.destroy', ['portfolioId' => $portfolio->id, 'education' => $edu->id]) }}" method="POST" 
                                          class="absolute top-3 right-3 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="h-6 w-6 rounded-full bg-red-500 flex items-center justify-center shadow-sm hover:bg-red-600 transition-colors">
                                            <svg class="w-3 h-3 text-white" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                                            </svg>
                                        </button>
                                    </form>
                                    <h3 class="text-xl font-semibold text-gray-800 mb-1 group-hover:text-amber-600 transition-colors">{{ $edu->degree }}</h3>
                                    <p class="text-gray-600">{{ $edu->institution }}</p>
                                    <p class="text-sm text-gray-500 mt-2">{{ $edu->year }}</p>
                                </div>
                            @empty
                                <div class="py-8 text-center">
                                    <p class="text-gray-500">No education details added yet.</p>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </section>

            <!-- Experience -->
            <section class="animate-fade-in">
                <div class="bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-100 h-full">
                    <div class="p-8 md:p-10">
                        <div class="flex items-center mb-8">
                            <div class="h-12 w-1 bg-gradient-to-b from-red-500 to-pink-500 rounded-full mr-4"></div>
                            <h2 class="text-3xl font-bold text-gray-900">Experience</h2>
                        </div>
                        
                        <div class="space-y-6">
                            @forelse ($portfolio->experience as $experience)
                                <div class="relative group bg-gradient-to-br from-red-50 to-white border border-red-100 rounded-xl p-6 transition-all duration-300 hover:shadow-md hover:border-red-200">
                                    <form action="{{ route('experiences.destroy', ['portfolioId' => $portfolio->id, 'experience' => $experience->id]) }}" method="POST" 
                                          class="absolute top-3 right-3 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="h-6 w-6 rounded-full bg-red-500 flex items-center justify-center shadow-sm hover:bg-red-600 transition-colors">
                                            <svg class="w-3 h-3 text-white" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                                            </svg>
                                        </button>
                                    </form>
                                    <h3 class="text-xl font-semibold text-gray-800 mb-1 group-hover:text-red-600 transition-colors">{{ $experience->position }}</h3>
                                    <p class="text-gray-600">{{ $experience->company }}</p>
                                    <p class="text-sm text-gray-500 mt-2">{{ $experience->duration }}</p>
                                </div>
                            @empty
                                <div class="py-8 text-center">
                                    <p class="text-gray-500">No experience details added yet.</p>
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