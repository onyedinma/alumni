<footer class="bg-secondary text-white pt-20 pb-10 border-t-4 border-gold-500">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-12 border-b border-gray-800 pb-12">
            <div class="col-span-1 md:col-span-1">
                <img src="{{ getSettingImage('app_logo') }}" alt="{{ getOption('app_name') }}"
                    class="h-12 w-auto mb-6 opacity-100">
                <p class="text-gray-300 leading-relaxed">
                    {{ getOption('footer_description') ?? 'Connect with ex-students, share memories, and build your professional network.' }}
                </p>
            </div>

            <div>
                <h4 class="text-xl font-serif font-bold mb-6 text-gold-500">Quick Links</h4>
                <ul class="space-y-4 font-sans">
                    <li><a href="{{ route('pages', 'about-us') }}"
                            class="text-gray-300 hover:text-gold-400 transition-colors">About Us</a></li>
                    <li><a href="{{ route('pages', 'constitution') }}"
                            class="text-gray-300 hover:text-gold-400 transition-colors">Constitution</a></li>
                    <li><a href="{{ route('all.event') }}"
                            class="text-gray-300 hover:text-gold-400 transition-colors">Events</a></li>
                    <li><a href="{{ route('all.stories') }}"
                            class="text-gray-300 hover:text-gold-400 transition-colors">Stories</a></li>
                    <li><a href="{{ route('contact_us') }}"
                            class="text-gray-300 hover:text-gold-400 transition-colors">Contact</a></li>
                </ul>
            </div>

            <div>
                <h4 class="text-xl font-serif font-bold mb-6 text-gold-500">Community</h4>
                <ul class="space-y-4 font-sans">
                    <li><a href="{{ route('all.alumni') }}"
                            class="text-gray-300 hover:text-gold-400 transition-colors">Find Alumni</a></li>
                    <li><a href="{{ route('all.job') }}"
                            class="text-gray-300 hover:text-gold-400 transition-colors">Jobs</a></li>
                    <li><a href="{{ route('all.membership') }}"
                            class="text-gray-300 hover:text-gold-400 transition-colors">Membership</a></li>
                    <li><a href="{{ route('donation.index') }}"
                            class="text-gray-300 hover:text-gold-400 transition-colors">Donate</a></li>
                </ul>
            </div>

            <div>
                <h4 class="text-xl font-serif font-bold mb-6 text-gold-500">Newsletter</h4>
                <p class="text-gray-300 mb-4 font-serif italic">Stay updated with the latest news.</p>
                <div class="flex">
                    <input type="email" placeholder="Enter your email"
                        class="w-full px-4 py-3 bg-white/5 border border-white/10 rounded-l-sm focus:outline-none focus:border-gold-500 text-white placeholder-gray-500">
                    <button
                        class="bg-gold-500 px-6 py-3 rounded-r-sm hover:bg-gold-600 transition-colors font-bold text-secondary">
                        <i class="fas fa-paper-plane"></i>
                    </button>
                </div>
            </div>
        </div>
        <div class="pt-8 flex flex-col md:flex-row justify-between items-center text-gray-300 text-sm">
            <p>© {{ date('Y') }} {{ getOption('app_name') }}. All rights reserved.</p>
            <div class="flex space-x-6 mt-4 md:mt-0">
                <a href="#" class="text-gray-300 hover:text-white transition-colors"><i
                        class="fab fa-facebook-f"></i></a>
                <a href="#" class="text-gray-300 hover:text-white transition-colors"><i class="fab fa-twitter"></i></a>
                <a href="#" class="text-gray-300 hover:text-white transition-colors"><i
                        class="fab fa-linkedin-in"></i></a>
                <a href="#" class="text-gray-300 hover:text-white transition-colors"><i
                        class="fab fa-instagram"></i></a>
            </div>
        </div>
    </div>
</footer>