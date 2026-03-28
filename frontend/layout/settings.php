<div class="settings">
    <a
        aria-controls="offcanvasSettings"
        aria-label="Theme Settings"
        class="btn btn-floating btn-icon btn-primary"
        data-bs-target="#offcanvasSettings"
        data-bs-toggle="offcanvas"
        href="#">
        <svg
            class="icon icon-1"
            fill="none"
            height="24"
            stroke="currentColor"
            stroke-linecap="round"
            stroke-linejoin="round"
            stroke-width="2"
            viewbox="0 0 24 24"
            width="24"
            xmlns="http://www.w3.org/2000/svg">
            <path d="M3 21v-4a4 4 0 1 1 4 4h-4"></path>
            <path d="M21 3a16 16 0 0 0 -12.8 10.2"></path>
            <path d="M21 3a16 16 0 0 1 -10.2 12.8"></path>
            <path d="M10.6 9a9 9 0 0 1 4.4 4.4"></path>
        </svg>
    </a>
    <form
        class="offcanvas offcanvas-start offcanvas-narrow"
        id="offcanvasSettings"
        tabindex="-1">
        <div class="offcanvas-header">
            <h2 class="offcanvas-title">Theme Settings</h2>
            <button
                aria-label="Close"
                class="btn-close"
                data-bs-dismiss="offcanvas"
                type="button"></button>
        </div>
        <div class="offcanvas-body d-flex flex-column">
            <div>
                <div class="mb-4">
                    <label class="form-label">Color mode</label>
                    <p class="form-hint">Choose the color mode for your app.</p>
                    <label class="form-check">
                        <div class="form-selectgroup-item">
                            <input
                                checked=""
                                class="form-check-input"
                                name="theme"
                                type="radio"
                                value="light" />
                            <div class="form-check-label">Light</div>
                        </div>
                    </label>
                    <label class="form-check">
                        <div class="form-selectgroup-item">
                            <input
                                class="form-check-input"
                                name="theme"
                                type="radio"
                                value="dark" />
                            <div class="form-check-label">Dark</div>
                        </div>
                    </label>
                </div>
                <div class="mb-4">
                    <label class="form-label">Color scheme</label>
                    <p class="form-hint">The perfect color mode for your app.</p>
                    <div class="row g-2">
                        <div class="col-auto">
                            <label class="form-colorinput">
                                <input
                                    class="form-colorinput-input"
                                    name="theme-primary"
                                    type="radio"
                                    value="blue" />
                                <span class="form-colorinput-color bg-blue"></span>
                            </label>
                        </div>
                        <div class="col-auto">
                            <label class="form-colorinput">
                                <input
                                    class="form-colorinput-input"
                                    name="theme-primary"
                                    type="radio"
                                    value="azure" />
                                <span class="form-colorinput-color bg-azure"></span>
                            </label>
                        </div>
                        <div class="col-auto">
                            <label class="form-colorinput">
                                <input
                                    class="form-colorinput-input"
                                    name="theme-primary"
                                    type="radio"
                                    value="indigo" />
                                <span class="form-colorinput-color bg-indigo"></span>
                            </label>
                        </div>
                        <div class="col-auto">
                            <label class="form-colorinput">
                                <input
                                    class="form-colorinput-input"
                                    name="theme-primary"
                                    type="radio"
                                    value="purple" />
                                <span class="form-colorinput-color bg-purple"></span>
                            </label>
                        </div>
                        <div class="col-auto">
                            <label class="form-colorinput">
                                <input
                                    class="form-colorinput-input"
                                    name="theme-primary"
                                    type="radio"
                                    value="pink" />
                                <span class="form-colorinput-color bg-pink"></span>
                            </label>
                        </div>
                        <div class="col-auto">
                            <label class="form-colorinput">
                                <input
                                    class="form-colorinput-input"
                                    name="theme-primary"
                                    type="radio"
                                    value="red" />
                                <span class="form-colorinput-color bg-red"></span>
                            </label>
                        </div>
                        <div class="col-auto">
                            <label class="form-colorinput">
                                <input
                                    class="form-colorinput-input"
                                    name="theme-primary"
                                    type="radio"
                                    value="orange" />
                                <span class="form-colorinput-color bg-orange"></span>
                            </label>
                        </div>
                        <div class="col-auto">
                            <label class="form-colorinput">
                                <input
                                    class="form-colorinput-input"
                                    name="theme-primary"
                                    type="radio"
                                    value="yellow" />
                                <span class="form-colorinput-color bg-yellow"></span>
                            </label>
                        </div>
                        <div class="col-auto">
                            <label class="form-colorinput">
                                <input
                                    class="form-colorinput-input"
                                    name="theme-primary"
                                    type="radio"
                                    value="lime" />
                                <span class="form-colorinput-color bg-lime"></span>
                            </label>
                        </div>
                        <div class="col-auto">
                            <label class="form-colorinput">
                                <input
                                    class="form-colorinput-input"
                                    name="theme-primary"
                                    type="radio"
                                    value="green" />
                                <span class="form-colorinput-color bg-green"></span>
                            </label>
                        </div>
                        <div class="col-auto">
                            <label class="form-colorinput">
                                <input
                                    class="form-colorinput-input"
                                    name="theme-primary"
                                    type="radio"
                                    value="teal" />
                                <span class="form-colorinput-color bg-teal"></span>
                            </label>
                        </div>
                        <div class="col-auto">
                            <label class="form-colorinput">
                                <input
                                    class="form-colorinput-input"
                                    name="theme-primary"
                                    type="radio"
                                    value="cyan" />
                                <span class="form-colorinput-color bg-cyan"></span>
                            </label>
                        </div>
                    </div>
                </div>
                <div class="mb-4">
                    <label class="form-label">Font family</label>
                    <p class="form-hint">
                        Choose the font family that fits your app.
                    </p>
                    <div>
                        <label class="form-check">
                            <div class="form-selectgroup-item">
                                <input
                                    checked=""
                                    class="form-check-input"
                                    name="theme-font"
                                    type="radio"
                                    value="sans-serif" />
                                <div class="form-check-label">Sans-serif</div>
                            </div>
                        </label>
                        <label class="form-check">
                            <div class="form-selectgroup-item">
                                <input
                                    class="form-check-input"
                                    name="theme-font"
                                    type="radio"
                                    value="serif" />
                                <div class="form-check-label">Serif</div>
                            </div>
                        </label>
                        <label class="form-check">
                            <div class="form-selectgroup-item">
                                <input
                                    class="form-check-input"
                                    name="theme-font"
                                    type="radio"
                                    value="monospace" />
                                <div class="form-check-label">Monospace</div>
                            </div>
                        </label>
                        <label class="form-check">
                            <div class="form-selectgroup-item">
                                <input
                                    class="form-check-input"
                                    name="theme-font"
                                    type="radio"
                                    value="comic" />
                                <div class="form-check-label">Comic</div>
                            </div>
                        </label>
                    </div>
                </div>
                <div class="mb-4">
                    <label class="form-label">Theme base</label>
                    <p class="form-hint">Choose the gray shade for your app.</p>
                    <div>
                        <label class="form-check">
                            <div class="form-selectgroup-item">
                                <input
                                    class="form-check-input"
                                    name="theme-base"
                                    type="radio"
                                    value="slate" />
                                <div class="form-check-label">Slate</div>
                            </div>
                        </label>
                        <label class="form-check">
                            <div class="form-selectgroup-item">
                                <input
                                    checked=""
                                    class="form-check-input"
                                    name="theme-base"
                                    type="radio"
                                    value="gray" />
                                <div class="form-check-label">Gray</div>
                            </div>
                        </label>
                        <label class="form-check">
                            <div class="form-selectgroup-item">
                                <input
                                    class="form-check-input"
                                    name="theme-base"
                                    type="radio"
                                    value="zinc" />
                                <div class="form-check-label">Zinc</div>
                            </div>
                        </label>
                        <label class="form-check">
                            <div class="form-selectgroup-item">
                                <input
                                    class="form-check-input"
                                    name="theme-base"
                                    type="radio"
                                    value="neutral" />
                                <div class="form-check-label">Neutral</div>
                            </div>
                        </label>
                        <label class="form-check">
                            <div class="form-selectgroup-item">
                                <input
                                    class="form-check-input"
                                    name="theme-base"
                                    type="radio"
                                    value="stone" />
                                <div class="form-check-label">Stone</div>
                            </div>
                        </label>
                    </div>
                </div>
                <div class="mb-4">
                    <label class="form-label">Corner Radius</label>
                    <p class="form-hint">
                        Choose the border radius factor for your app.
                    </p>
                    <div>
                        <label class="form-check">
                            <div class="form-selectgroup-item">
                                <input
                                    class="form-check-input"
                                    name="theme-radius"
                                    type="radio"
                                    value="0" />
                                <div class="form-check-label">0</div>
                            </div>
                        </label>
                        <label class="form-check">
                            <div class="form-selectgroup-item">
                                <input
                                    class="form-check-input"
                                    name="theme-radius"
                                    type="radio"
                                    value="0.5" />
                                <div class="form-check-label">0.5</div>
                            </div>
                        </label>
                        <label class="form-check">
                            <div class="form-selectgroup-item">
                                <input
                                    checked=""
                                    class="form-check-input"
                                    name="theme-radius"
                                    type="radio"
                                    value="1" />
                                <div class="form-check-label">1</div>
                            </div>
                        </label>
                        <label class="form-check">
                            <div class="form-selectgroup-item">
                                <input
                                    class="form-check-input"
                                    name="theme-radius"
                                    type="radio"
                                    value="1.5" />
                                <div class="form-check-label">1.5</div>
                            </div>
                        </label>
                        <label class="form-check">
                            <div class="form-selectgroup-item">
                                <input
                                    class="form-check-input"
                                    name="theme-radius"
                                    type="radio"
                                    value="2" />
                                <div class="form-check-label">2</div>
                            </div>
                        </label>
                    </div>
                </div>
            </div>
            <div class="mt-auto space-y">
                <button class="btn w-100" id="reset-changes" type="button">
                    <svg
                        class="icon icon-1"
                        fill="none"
                        height="24"
                        stroke="currentColor"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        viewbox="0 0 24 24"
                        width="24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path d="M19.95 11a8 8 0 1 0 -.5 4m.5 5v-5h-5"></path>
                    </svg>
                    Reset changes
                </button>
                <a
                    class="btn btn-primary w-100"
                    data-bs-dismiss="offcanvas"
                    href="#">
                    Save
                </a>
            </div>
        </div>
    </form>
</div>