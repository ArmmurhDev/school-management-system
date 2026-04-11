<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>T & T School – Sample Result Card</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Roboto, Arial, sans-serif;
        }
        body {
            background: #ddd;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            padding: 20px;
        }
        .report-card {
            max-width: 900px;
            width: 100%;
            background: white;
            box-shadow: 0 10px 30px rgba(0,0,0,0.2);
            padding: 30px 40px;
            position: relative;
            border-radius: 8px;
            overflow: hidden;
        }
        /* Watermark effect */
        .watermark {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
            pointer-events: none;
            opacity: 0.1;
            font-size: 6rem;
            font-weight: bold;
            color: #aaa;
            transform: rotate(-30deg) scale(1.2);
            white-space: nowrap;
            z-index: 0;
        }
        .content {
            position: relative;
            z-index: 1;
        }
        .header {
            display: flex;
            align-items: center;
            border-bottom: 2px solid #004080;
            padding-bottom: 15px;
            margin-bottom: 20px;
        }
        .logo {
            width: 80px;
            height: 80px;
            background: #004080;
            color: white;
            font-size: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            margin-right: 20px;
            font-weight: bold;
            text-align: center;
            line-height: 1.2;
        }
        .school-info {
            flex: 1;
        }
        .school-info h1 {
            color: #004080;
            font-size: 2rem;
            letter-spacing: 1px;
        }
        .school-info p {
            color: #333;
            font-size: 0.9rem;
        }
        .title {
            text-align: center;
            margin: 20px 0;
            font-size: 1.5rem;
            font-weight: bold;
            text-transform: uppercase;
            color: #004080;
            border-bottom: 1px dashed #aaa;
            padding-bottom: 10px;
        }
        .student-details {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            background: #f5f9ff;
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 25px;
        }
        .student-details div {
            flex: 1 1 200px;
        }
        .student-details strong {
            color: #004080;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
            font-size: 0.95rem;
        }
        th {
            background: #004080;
            color: white;
            padding: 10px 5px;
            font-weight: 600;
        }
        td, th {
            border: 1px solid #ccc;
            padding: 8px 5px;
            text-align: center;
        }
        td.subject {
            text-align: left;
            padding-left: 10px;
        }
        .summary {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            background: #f0f0f0;
            padding: 15px;
            border-radius: 8px;
            margin: 20px 0;
        }
        .summary-item {
            flex: 1 1 150px;
            margin: 5px;
        }
        .summary-item .label {
            font-weight: bold;
            color: #004080;
        }
        .comments {
            margin: 25px 0;
            padding: 15px;
            background: #fafafa;
            border-left: 5px solid #004080;
        }
        .signatures {
            display: flex;
            justify-content: space-between;
            margin: 30px 0 15px;
        }
        .signature-box {
            text-align: center;
            width: 200px;
        }
        .signature-line {
            border-top: 1px solid #333;
            width: 100%;
            margin: 5px 0;
            padding-top: 5px;
        }
        .footer {
            text-align: center;
            font-size: 0.8rem;
            color: #666;
            margin-top: 20px;
            border-top: 1px solid #ccc;
            padding-top: 15px;
        }
    </style>
</head>
<body>
    <div class="report-card">
        <!-- Watermark -->
        <div class="watermark">T & T SCHOOL</div>
        
        <div class="content">
            <!-- Header with Logo and School Info -->
            <div class="header">
                <div class="logo">T&T<br>SCHOOL</div>
                <div class="school-info">
                    <h1>T & T SCHOOL</h1>
                    <p>123 Education Avenue, Knowledge City | +234 801 234 5678 | info@ttschool.edu</p>
                </div>
            </div>

            <!-- Report Title -->
            <div class="title">STUDENT RESULT CARD – FIRST TERM 2024</div>

            <!-- Student Details -->
            <div class="student-details">
                <div><strong>Name:</strong> John Doe</div>
                <div><strong>Admission No:</strong> TT2024001</div>
                <div><strong>Class:</strong> Form 3A</div>
                <div><strong>Term:</strong> First Term 2024</div>
            </div>

            <!-- Results Table -->
            <table>
                <thead>
                    <tr>
                        <th>Subject</th>
                        <th>CA (40)</th>
                        <th>Exam (60)</th>
                        <th>Total (100)</th>
                        <th>Grade</th>
                        <th>Remark</th>
                    </tr>
                </thead>
                <tbody>
                    <tr><td class="subject">Mathematics</td><td>35</td><td>55</td><td>90</td><td>A</td><td>Excellent</td></tr>
                    <tr><td class="subject">English Language</td><td>28</td><td>48</td><td>76</td><td>B</td><td>Very Good</td></tr>
                    <tr><td class="subject">Basic Science</td><td>30</td><td>50</td><td>80</td><td>A</td><td>Excellent</td></tr>
                    <tr><td class="subject">Social Studies</td><td>25</td><td>42</td><td>67</td><td>B</td><td>Very Good</td></tr>
                    <tr><td class="subject">Agricultural Science</td><td>32</td><td>45</td><td>77</td><td>B</td><td>Very Good</td></tr>
                    <tr><td class="subject">Computer Studies</td><td>38</td><td>58</td><td>96</td><td>A</td><td>Excellent</td></tr>
                    <tr><td class="subject">Physical Education</td><td>27</td><td>43</td><td>70</td><td>B</td><td>Good</td></tr>
                </tbody>
            </table>

            <!-- Summary Section -->
            <div class="summary">
                <div class="summary-item"><span class="label">Total Subjects:</span> 10</div>
                <div class="summary-item"><span class="label">Total Score:</span> 820</div>
                <div class="summary-item"><span class="label">Average:</span> 82.0</div>
                <div class="summary-item"><span class="label">Position:</span> 2nd / 35</div>
                <div class="summary-item"><span class="label">Overall Grade:</span> A</div>
                <div class="summary-item"><span class="label">Overall Remark:</span> Excellent</div>
            </div>

            <!-- Comments -->
            <div class="comments">
                <p><strong>Class Teacher's Comment:</strong> John is a brilliant student who shows great dedication. Keep it up!</p>
                <p style="margin-top:10px;"><strong>Principal's Comment:</strong> We are proud of your performance. Continue to excel.</p>
            </div>

            <!-- Signatures -->
            <div class="signatures">
                <div class="signature-box">
                    <div class="signature-line">Mrs. Jane Smith</div>
                    <div>Class Teacher</div>
                </div>
                <div class="signature-box">
                    <div class="signature-line">Dr. Peter Adebayo</div>
                    <div>Principal</div>
                </div>
            </div>

            <!-- Footer -->
            <div class="footer">
                Generated: March 5, 2024 at 10:30 AM
            </div>
        </div>
    </div>
</body>
</html>