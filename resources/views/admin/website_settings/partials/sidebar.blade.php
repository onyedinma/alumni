<div class="">
    <div class="sidebar__item">
        <ul class="d-flex flex-column rg-15 sidebar__mail__nav p-0 m-0" style="list-style: none;">
            <li>
                <a href="{{ route('admin.setting.website-settings.index') }}"
                    class="align-items-center flex list-item {{ @$subWebsiteSettingActiveClass }}">
                    <i class="fa fa-globe fs-18"></i>
                    <span class="font-bold fs-14">{{__('Common Setting')}}</span>
                </a>
            </li>
            <li>
                <a class="align-items-center flex list-item {{ @$bannerSettingActiveClass }}"
                    href="{{ route('admin.setting.website-settings.banner.setting') }}">
                    <i class="fa fa-flag fs-18"></i>
                    <span class="font-bold fs-14">{{ __('Banner Setting') }}</span>
                </a>
            </li>
            <li>
                <a class="align-items-center flex list-item {{ @$whyJoinWithUsActiveClass }}"
                    href="{{ route('admin.setting.website-settings.why-you-should-join-us') }}">
                    <i class="fa fa-users-rays fs-18"></i>
                    <span class="font-bold fs-14">{{ __('Why Join With Us') }}</span>
                </a>
            </li>
            <li>
                <a class="align-items-center flex list-item {{ @$aboutUsActiveClass }}"
                    href="{{ route('admin.setting.website-settings.about-us') }}">
                    <i class="fa fa-address-card fs-18"></i>
                    <span class="font-bold fs-14">{{ __('About Us') }}</span>
                </a>
            </li>
            <li>
                <a class="align-items-center flex list-item {{ @$activeImageGallerySetting }}"
                    href="{{ route('admin.setting.website-settings.image_galleries.index') }}">
                    <i class="fa fa-images fs-18"></i>
                    <span class="font-bold fs-14">{{ __('Image Gallery') }}</span>
                </a>
            </li>
            <li>
                <a class="align-items-center flex list-item {{ @$privacyPolicyActiveClass }}"
                    href="{{ route('admin.setting.website-settings.privacy-policy') }}">
                    <i class="fa-solid fa-file-shield fs-18"></i>
                    <span class="font-bold fs-14">{{ __('Privacy Policy') }}</span>
                </a>
            </li>
            <li>
                <a class="align-items-center flex list-item {{ @$cookiePolicyActiveClass }}"
                    href="{{ route('admin.setting.website-settings.cookie-policy') }}">
                    <i class="fa-solid fa-cookie-bite fs-18"></i>
                    <span class="font-bold fs-14">{{ __('Cookie Policy') }}</span>
                </a>
            </li>
            <li>
                <a class="align-items-center flex list-item {{ @$termsConditionActiveClass }}"
                    href="{{ route('admin.setting.website-settings.terms-condition') }}">
                    <i class="fa-solid fa-file-contract fs-18"></i>
                    <span class="font-bold fs-14">{{ __('Terms And Condition') }}</span>
                </a>
            </li>
            <li>
                <a class="align-items-center flex list-item {{ @$refundPolicyActiveClass }}"
                    href="{{ route('admin.setting.website-settings.refund-policy') }}">
                    <i class="fa-solid fa-file-invoice-dollar fs-18"></i>
                    <span class="font-bold fs-14">{{ __('Refund Policy') }}</span>
                </a>
            </li>
            <li>
                <a class="align-items-center flex list-item {{ @$constitutionActiveClass }}"
                    href="{{ route('admin.setting.website-settings.constitution') }}">
                    <i class="fa-solid fa-scroll fs-18"></i>
                    <span class="font-bold fs-14">{{ __('Constitution') }}</span>
                </a>
            </li>
            <li>
                <a class="align-items-center flex list-item {{ @$ourHistoryActiveClass }}"
                    href="{{ route('admin.setting.website-settings.our-history') }}">
                    <i class="fa-solid fa-landmark fs-18"></i>
                    <span class="font-bold fs-14">{{ __('Our History') }}</span>
                </a>
            </li>
            <li>
                <a class="align-items-center flex list-item {{ @$contactUsActiveClass }}"
                    href="{{ route('admin.setting.website-settings.contact-us') }}">
                    <i class="fa-solid fa-address-book fs-18"></i>
                    <span class="font-bold fs-14">{{ __('Contact Us') }}</span>
                </a>
            </li>
        </ul>
    </div>
</div>