@extends('front.layouts.master')
@section('title', 'User Login')

@section('css')

    <style>
        :root {
            --scp-primary: #0F6EFF;
            --scp-dark: #00150F;
            --scp-muted: #adb5bd;
            --scp-bg: #081C17;
        }

        body {
            background: var(--scp-bg);
        }

        .scp-hero {
            background: linear-gradient(135deg, #0F6EFF 0%, #1b3b78 100%);
            color: #fff;
            padding: 4rem 0 3rem;
        }

        .scp-card {
            background: #00150f;
            border: 0;
            border-radius: 1rem;
            box-shadow: 0 10px 30px rgba(13, 110, 253, .08);
        }

        .scp-stamp {
            font-size: .875rem;
            color: #fff;
            letter-spacing: .04em;
        }

        .list-check li {
            margin-bottom: .5rem;
        }

        .list-check li::marker {
            content: "✔ ";
            color: var(--scp-primary);
            font-weight: 700;
        }

        .toc a {
            text-decoration: none;
        }

        .toc a:hover {
            text-decoration: underline;
        }

        .badge-soft {
            background: rgba(15, 110, 255, .10);
            color: var(--scp-primary);
            border: 1px solid rgba(15, 110, 255, .25);
        }

        .small-muted {
            color: var(--scp-muted);
            font-size: .925rem;
        }

        pre,
        code {
            white-space: pre-wrap;
        }
    </style>

@endsection

@section('content')


    <!-- ================== About Us Section ================== -->
    <section class="about about--style1">
        <div class="container">
            <div class="mt-5">
                <div class="row g-4">
                    <div class="col-12 col-lg-3">
                        <div class="scp-card p-3 sticky-top" style="top: 1rem;">
                            <h6 class="text-uppercase small fw-bold mb-3">On this page</h6>
                            <nav class="toc small d-grid gap-2">
                                <a href="#who-we-are">1. Who We Are</a>
                                <a href="#scope">2. Scope</a>
                                <a href="#data-we-collect">3. Data We Collect</a>
                                <a href="#how-we-use">4. How We Use Data</a>
                                <a href="#legal-basis">5. Legal Basis</a>
                                <a href="#cookies">6. Cookies & Tracking</a>
                                <a href="#sharing">7. Sharing & Disclosures</a>
                                <a href="#retention">8. Data Retention</a>
                                <a href="#security">9. Security</a>
                                <a href="#your-rights">10. Your Rights</a>
                                <a href="#intl">11. International Transfers</a>
                                <a href="#children">12. Children’s Privacy</a>
                                <a href="#links">13. Third-Party Links</a>
                                <a href="#changes">14. Changes to This Policy</a>
                                <a href="#contact">15. Contact Us</a>
                            </nav>
                        </div>
                    </div>

                    <div class="col-12 col-lg-9">
                        <section id="who-we-are" class="scp-card p-4 p-md-5 mb-4">
                            <h2 class="h4 fw-bold">1) Who We Are</h2>
                            <p>Trade Pluss (“<strong>Company</strong>,” “<strong>we</strong>,” “<strong>us</strong>,” or
                                “<strong>our</strong>”) operates a digital platform that enables users to make investments,
                                receive daily returns, participate in referral programs, and access rewards and salary-based
                                incentives. This Privacy Policy explains how we collect, use, disclose, and protect personal
                                information when you use our website, mobile experiences, and related services
                                (collectively, the “<strong>Services</strong>”).</p>
                            <p class="small-muted mb-0"><span class="badge badge-soft rounded-pill me-2">Note</span>By using
                                our Services, you agree to the practices described in this Privacy Policy.</p>
                        </section>

                        <section id="scope" class="scp-card p-4 p-md-5 mb-4">
                            <h2 class="h4 fw-bold">2) Scope</h2>
                            <p>This Policy applies to personal information we collect online through our website and
                                portals, and offline where we reference this Policy. Separate terms may apply to specific
                                products or regions; where there is a conflict, the product-specific or regional terms
                                control.</p>
                        </section>

                        <section id="data-we-collect" class="scp-card p-4 p-md-5 mb-4">
                            <h2 class="h4 fw-bold">3) Information We Collect</h2>
                            <div class="row g-3">
                                <div class="col-12 col-md-6">
                                    <h6 class="text-uppercase small fw-bold">Information you provide</h6>
                                    <ul class="list-check ps-3">
                                        <li>Account &amp; profile: name, username, email, phone, password (hashed), KYC
                                            details (if applicable).</li>
                                        <li>Financial operations: investment amounts, transaction IDs, payment
                                            screenshots/receipts, bank details (masked where possible).</li>
                                        <li>Referrals: referral codes, referring/ referred user IDs.</li>
                                        <li>Support: messages, attachments, feedback.</li>
                                    </ul>
                                </div>
                                <div class="col-12 col-md-6">
                                    <h6 class="text-uppercase small fw-bold">Information collected automatically</h6>
                                    <ul class="list-check ps-3">
                                        <li>Device &amp; log data: IP address, browser type, OS, timestamps, pages viewed,
                                            and error logs.</li>
                                        <li>Cookies &amp; similar: session tokens, analytics identifiers, preference
                                            cookies.</li>
                                        <li>Approximate location: derived from IP (where permitted).</li>
                                    </ul>
                                </div>
                            </div>
                            <div class="mt-3">
                                <h6 class="text-uppercase small fw-bold">Information from third parties</h6>
                                <ul class="list-check ps-3">
                                    <li>Payment processors and banks (confirmation, status, limited identifiers).</li>
                                    <li>Analytics and anti-fraud providers.</li>
                                    <li>Marketing partners (campaign performance, referral source).</li>
                                </ul>
                            </div>
                        </section>

                        <section id="how-we-use" class="scp-card p-4 p-md-5 mb-4">
                            <h2 class="h4 fw-bold">4) How We Use Your Information</h2>
                            <ul class="list-check ps-3">
                                <li>Provide and manage the Services (accounts, investments, returns, commissions, rewards,
                                    salary programs).</li>
                                <li>Process payments, withdrawals, fees, and verify transactions.</li>
                                <li>Maintain security, prevent fraud, enforce terms, and comply with law.</li>
                                <li>Communicate about approvals, account alerts, product updates, and promotions (where
                                    permitted).</li>
                                <li>Analyze usage to improve performance, features, and user experience.</li>
                                <li>Personalize content such as dashboards, recommendations, and referral materials.</li>
                            </ul>
                        </section>

                        <section id="legal-basis" class="scp-card p-4 p-md-5 mb-4">
                            <h2 class="h4 fw-bold">5) Legal Basis for Processing (where applicable)</h2>
                            <ul class="list-check ps-3">
                                <li><strong>Contract</strong> – to deliver the Services you request.</li>
                                <li><strong>Legitimate interests</strong> – to secure our platform, prevent abuse, and
                                    improve Services.</li>
                                <li><strong>Consent</strong> – for certain marketing, cookies, or optional data.</li>
                                <li><strong>Legal obligation</strong> – to meet regulatory, tax, AML/KYC, or accounting
                                    requirements.</li>
                            </ul>
                        </section>

                        <section id="cookies" class="scp-card p-4 p-md-5 mb-4">
                            <h2 class="h4 fw-bold">6) Cookies &amp; Similar Technologies</h2>
                            <p>We use cookies and similar technologies to keep you signed in, store preferences, and measure
                                performance. You can control cookies through your browser settings. Some features may not
                                work correctly without certain cookies.</p>
                        </section>

                        <section id="sharing" class="scp-card p-4 p-md-5 mb-4">
                            <h2 class="h4 fw-bold">7) How We Share Information</h2>
                            <p>We do not sell personal information. We may share limited data with:</p>
                            <ul class="list-check ps-3">
                                <li>Payment providers/banks to process deposits and withdrawals.</li>
                                <li>Service providers under contract (hosting, analytics, security, communications).</li>
                                <li>Affiliates and professional advisors (accounting, legal, compliance).</li>
                                <li>Authorities when required by law, to protect rights, or prevent harm.</li>
                                <li>In a merger, acquisition, or asset transfer, consistent with this Policy.</li>
                            </ul>
                        </section>

                        <section id="retention" class="scp-card p-4 p-md-5 mb-4">
                            <h2 class="h4 fw-bold">8) Data Retention</h2>
                            <p>We keep personal information for as long as needed to provide Services, comply with legal and
                                regulatory obligations, resolve disputes, and enforce agreements. Retention periods may vary
                                by data category and jurisdiction.</p>
                        </section>

                        <section id="security" class="scp-card p-4 p-md-5 mb-4">
                            <h2 class="h4 fw-bold">9) Security</h2>
                            <p>We implement administrative, technical, and physical safeguards designed to protect personal
                                information, including encryption in transit (HTTPS), access controls, logging, and periodic
                                reviews. No system is 100% secure; please use strong, unique passwords and enable two-factor
                                authentication where available.</p>
                        </section>

                        <section id="your-rights" class="scp-card p-4 p-md-5 mb-4">
                            <h2 class="h4 fw-bold">10) Your Privacy Choices &amp; Rights</h2>
                            <p>Depending on your location, you may have rights such as access, correction, deletion,
                                portability, objection, and restriction. To exercise these rights or update preferences,
                                contact us using the details below. We will verify your request and respond as required by
                                applicable law.</p>
                        </section>

                        <section id="intl" class="scp-card p-4 p-md-5 mb-4">
                            <h2 class="h4 fw-bold">11) International Transfers</h2>
                            <p>We may process and store information in countries different from where you reside. Where
                                required, we implement appropriate safeguards for cross-border data transfers.</p>
                        </section>

                        <section id="children" class="scp-card p-4 p-md-5 mb-4">
                            <h2 class="h4 fw-bold">12) Children’s Privacy</h2>
                            <p>Our Services are not directed to children under 18, and we do not knowingly collect personal
                                information from them. If you believe a minor provided us data, please contact us so we can
                                take appropriate action.</p>
                        </section>

                        <section id="links" class="scp-card p-4 p-md-5 mb-4">
                            <h2 class="h4 fw-bold">13) Third-Party Links &amp; Services</h2>
                            <p>Our Services may contain links to third-party websites or integrations. We are not
                                responsible for the privacy practices of those third parties. Please review their policies.
                            </p>
                        </section>

                        <section id="changes" class="scp-card p-4 p-md-5 mb-4">
                            <h2 class="h4 fw-bold">14) Changes to This Policy</h2>
                            <p>We may update this Privacy Policy from time to time. We will post the latest version on this
                                page and update the “Last updated” date above. Significant changes may be communicated via
                                email or in-app notice.</p>
                        </section>

                        <section id="contact" class="scp-card p-4 p-md-5">
                            <h2 class="h4 fw-bold">15) Contact Us</h2>
                            <p>If you have questions or requests about this Policy or our data practices, contact:</p>
                            <address class="mb-0">
                                <strong>Trade Pluss</strong><br>
                                Support: <a href="mailto:support@tradepluss.com">support@tradepluss.com</a><br>
                                Compliance: <a href="mailto:privacy@safecapitalpro.com">privacy@safecapitalpro.com</a><br>
                            </address>
                        </section>
                    </div>
                </div>
            </div>
        </div> <!-- end container -->
    </section>
    <!-- ================== End About Us Section ================== -->

@endsection
