<?php

namespace App\Providers;

use App\Models\SchoolInquiry;
use App\Models\OnlineExamQuestionCommon;
use App\Repositories\FeesClassType\FeesClassTypeInterface;
use App\Repositories\FeesInstallment\FeesInstallmentInterface;
use Illuminate\Support\ServiceProvider;
use App\Repositories\Exam\ExamInterface;
use App\Repositories\Fees\FeesInterface;
use App\Repositories\User\UserInterface;
use App\Repositories\Exam\ExamRepository;
use App\Repositories\Fees\FeesRepository;
use App\Repositories\User\UserRepository;
use App\Repositories\Addon\AddonInterface;
use App\Repositories\Files\FilesInterface;
use App\Repositories\Shift\ShiftInterface;
use App\Repositories\Staff\StaffInterface;
use App\Repositories\Addon\AddonRepository;
use App\Repositories\Files\FilesRepository;
use App\Repositories\Shift\ShiftRepository;
use App\Repositories\Staff\StaffRepository;
use App\Repositories\Grades\GradesInterface;
use App\Repositories\Medium\MediumInterface;
use App\Repositories\School\SchoolInterface;
use App\Repositories\Stream\StreamInterface;
use App\Repositories\Topics\TopicsInterface;
use App\Repositories\Grades\GradesRepository;
use App\Repositories\Medium\MediumRepository;
use App\Repositories\School\SchoolRepository;
use App\Repositories\Stream\StreamRepository;
use App\Repositories\Topics\TopicsRepository;
use App\Repositories\Expense\ExpenseInterface;
use App\Repositories\Feature\FeatureInterface;
use App\Repositories\Holiday\HolidayInterface;
use App\Repositories\Lessons\LessonsInterface;
use App\Repositories\Package\PackageInterface;
use App\Repositories\Section\SectionInterface;
use App\Repositories\Sliders\SlidersInterface;
use App\Repositories\Student\StudentInterface;
use App\Repositories\Subject\SubjectInterface;
use App\Repositories\Expense\ExpenseRepository;
use App\Repositories\Feature\FeatureRepository;
use App\Repositories\Holiday\HolidayRepository;
use App\Repositories\Lessons\LessonsRepository;
use App\Repositories\Package\PackageRepository;
use App\Repositories\Section\SectionRepository;
use App\Repositories\Sliders\SlidersRepository;
use App\Repositories\Student\StudentRepository;
use App\Repositories\Subject\SubjectRepository;
use App\Repositories\FeesPaid\FeesPaidInterface;
use App\Repositories\FeesType\FeesTypeInterface;
use App\Repositories\Semester\SemesterInterface;
use App\Repositories\FeesPaid\FeesPaidRepository;
use App\Repositories\FeesType\FeesTypeRepository;
use App\Repositories\Languages\LanguageInterface;
use App\Repositories\Semester\SemesterRepository;
use App\Repositories\ExamMarks\ExamMarksInterface;
use App\Repositories\Languages\LanguageRepository;
use App\Repositories\Timetable\TimetableInterface;
use App\Repositories\ExamMarks\ExamMarksRepository;
use App\Repositories\FeesClassType\FeesClassTypeRepository;
use App\Repositories\FormField\FormFieldsInterface;
use App\Repositories\Timetable\TimetableRepository;
use App\Repositories\Assignment\AssignmentInterface;
use App\Repositories\Attendance\AttendanceInterface;
use App\Repositories\ExamResult\ExamResultInterface;
use App\Repositories\FormField\FormFieldsRepository;
use App\Repositories\OnlineExam\OnlineExamInterface;
use App\Repositories\Assignment\AssignmentRepository;
use App\Repositories\Attendance\AttendanceRepository;
use App\Repositories\ExamResult\ExamResultRepository;
use App\Repositories\OnlineExam\OnlineExamRepository;
use App\Repositories\ClassSchool\ClassSchoolInterface;
use App\Repositories\OptionalFee\OptionalFeeInterface;
use App\Repositories\SessionYear\SessionYearInterface;
use App\Repositories\ClassSchool\ClassSchoolRepository;
use App\Repositories\OptionalFee\OptionalFeeRepository;
use App\Repositories\SessionYear\SessionYearRepository;
use App\Repositories\Announcement\AnnouncementInterface;
use App\Repositories\ClassSection\ClassSectionInterface;
use App\Repositories\ClassSubject\ClassSubjectInterface;
use App\Repositories\Subscription\SubscriptionInterface;
use App\Repositories\Announcement\AnnouncementRepository;
use App\Repositories\ClassSection\ClassSectionRepository;
use App\Repositories\ClassSubject\ClassSubjectRepository;
use App\Repositories\Subscription\SubscriptionRepository;
use App\Repositories\ClassTeachers\ClassTeachersInterface;
use App\Repositories\CompulsoryFee\CompulsoryFeeInterface;
use App\Repositories\ExamTimetable\ExamTimetableInterface;
use App\Repositories\SchoolSetting\SchoolSettingInterface;
use App\Repositories\SystemSetting\SystemSettingInterface;
use App\Repositories\ClassTeachers\ClassTeachersRepository;
use App\Repositories\CompulsoryFee\CompulsoryFeeRepository;
use App\Repositories\ExamTimetable\ExamTimetableRepository;
use App\Repositories\SchoolSetting\SchoolSettingRepository;
use App\Repositories\SystemSetting\SystemSettingRepository;
use App\Repositories\PackageFeature\PackageFeatureInterface;
use App\Repositories\PromoteStudent\PromoteStudentInterface;
use App\Repositories\StudentSubject\StudentSubjectInterface;
use App\Repositories\SubjectTeacher\SubjectTeacherInterface;
use App\Repositories\ExtraFormField\ExtraFormFieldsInterface;
use App\Repositories\PackageFeature\PackageFeatureRepository;
use App\Repositories\PromoteStudent\PromoteStudentRepository;
use App\Repositories\StudentSubject\StudentSubjectRepository;
use App\Repositories\SubjectTeacher\SubjectTeacherRepository;
use App\Repositories\ExpenseCategory\ExpenseCategoryInterface;
use App\Repositories\ExtraFormField\ExtraFormFieldsRepository;
use App\Repositories\FeesInstallment\FeesInstallmentRepository;
use App\Repositories\ExpenseCategory\ExpenseCategoryRepository;
use App\Repositories\SubscriptionBill\SubscriptionBillInterface;
use App\Repositories\SubscriptionBill\SubscriptionBillRepository;
use App\Repositories\AddonSubscription\AddonSubscriptionInterface;
use App\Repositories\AnnouncementClass\AnnouncementClassInterface;
use App\Repositories\AddonSubscription\AddonSubscriptionRepository;
use App\Repositories\AnnouncementClass\AnnouncementClassRepository;
use App\Repositories\AssignmentCommon\AssignmentCommonInterface;
use App\Repositories\AssignmentCommon\AssignmentCommonRepository;
use App\Repositories\OnlineExamQuestion\OnlineExamQuestionInterface;
use App\Repositories\PaymentTransaction\PaymentTransactionInterface;
use App\Repositories\OnlineExamQuestion\OnlineExamQuestionRepository;
use App\Repositories\PaymentTransaction\PaymentTransactionRepository;
use App\Repositories\AssignmentSubmission\AssignmentSubmissionInterface;
use App\Repositories\ElectiveSubjectGroup\ElectiveSubjectGroupInterface;
use App\Repositories\PaymentConfiguration\PaymentConfigurationInterface;
use App\Repositories\AssignmentSubmission\AssignmentSubmissionRepository;
use App\Repositories\Attachment\AttachmentInterface;
use App\Repositories\Attachment\AttachmentRepository;
use App\Repositories\CertificateTemplate\CertificateTemplateInterface;
use App\Repositories\CertificateTemplate\CertificateTemplateRepository;
use App\Repositories\Chat\ChatInterface;
use App\Repositories\Chat\ChatRepository;
use App\Repositories\ContactInquiry\ContactInquiryInterface;
use App\Repositories\ContactInquiry\ContactInquiryRepository;
use App\Repositories\ClassGroup\ClassGroupInterface;
use App\Repositories\ClassGroup\ClassGroupRepository;
use App\Repositories\DatabaseBackup\DatabaseBackupInterface;
use App\Repositories\DatabaseBackup\DatabaseBackupRepository;
use App\Repositories\ElectiveSubjectGroup\ElectiveSubjectGroupRepository;
use App\Repositories\Faqs\FaqsInterface;
use App\Repositories\Faqs\FaqsRepository;
use App\Repositories\FeatureSection\FeatureSectionInterface;
use App\Repositories\FeatureSection\FeatureSectionRepository;
use App\Repositories\FeatureSectionList\FeatureSectionListInterface;
use App\Repositories\FeatureSectionList\FeatureSectionListRepository;
use App\Repositories\Gallery\GalleryInterface;
use App\Repositories\Gallery\GalleryRepository;
use App\Repositories\Guidance\GuidanceInterface;
use App\Repositories\Guidance\GuidanceRepository;
use App\Repositories\Leave\LeaveInterface;
use App\Repositories\Leave\LeaveRepository;
use App\Repositories\LeaveDetail\LeaveDetailInterface;
use App\Repositories\LeaveDetail\LeaveDetailRepository;
use App\Repositories\LeaveMaster\LeaveMasterInterface;
use App\Repositories\LeaveMaster\LeaveMasterRepository;
use App\Repositories\LessonsCommon\LessonsCommonInterface;
use App\Repositories\LessonsCommon\LessonsCommonRepository;
use App\Repositories\Message\MessageInterface;
use App\Repositories\Message\MessageRepository;
use App\Repositories\Notification\NotificationInterface;
use App\Repositories\Notification\NotificationRepository;
use App\Repositories\OnlineExamCommon\OnlineExamCommonInterface;
use App\Repositories\OnlineExamCommon\OnlineExamCommonRepository;
use App\Repositories\PaymentConfiguration\PaymentConfigurationRepository;
use App\Repositories\OnlineExamStudentAnswer\OnlineExamStudentAnswerInterface;
use App\Repositories\StudentOnlineExamStatus\StudentOnlineExamStatusInterface;
use App\Repositories\OnlineExamStudentAnswer\OnlineExamStudentAnswerRepository;
use App\Repositories\StudentOnlineExamStatus\StudentOnlineExamStatusRepository;
use App\Repositories\OnlineExamQuestionChoice\OnlineExamQuestionChoiceInterface;
use App\Repositories\OnlineExamQuestionOption\OnlineExamQuestionOptionInterface;
use App\Repositories\OnlineExamQuestionChoice\OnlineExamQuestionChoiceRepository;
use App\Repositories\OnlineExamQuestionCommon\OnlineExamQuestionCommonRepository;
use App\Repositories\OnlineExamQuestionOption\OnlineExamQuestionOptionRepository;
use App\Repositories\StaffSupportSchool\StaffSupportSchoolInterface;
use App\Repositories\StaffSupportSchool\StaffSupportSchoolRepository;
use App\Repositories\SubscriptionBillPayment\SubscriptionBillPaymentInterface;
use App\Repositories\SubscriptionBillPayment\SubscriptionBillPaymentRepository;
use App\Repositories\SubscriptionFeature\SubscriptionFeatureInterface;
use App\Repositories\SubscriptionFeature\SubscriptionFeatureRepository;
use App\Repositories\UserStatusForNextCycle\UserStatusForNextCycleInterface;
use App\Repositories\UserStatusForNextCycle\UserStatusForNextCycleRepository;
use App\Repositories\PayrollSetting\PayrollSettingInterface;
use App\Repositories\PayrollSetting\PayrollSettingRepository;
use App\Repositories\StaffPayroll\StaffPayrollInterface;
use App\Repositories\StaffPayroll\StaffPayrollRepository;
use App\Repositories\StaffSalary\StaffSalaryInterface;
use App\Repositories\StaffSalary\StaffSalaryRepository;
use App\Repositories\SchoolInquiry\SchoolInquiryInterface;
use App\Repositories\SchoolInquiry\SchoolInquiryRepository;
use App\Repositories\ExtraSchoolData\ExtraSchoolDataInterface;
use App\Repositories\ExtraSchoolData\ExtraSchoolDataRepository;
use App\Repositories\TopicCommon\TopicCommonInterface;
use App\Repositories\TopicCommon\TopicCommonRepository;
use App\Repositories\OnlineExamQuestionCommon\OnlineExamQuestionCommonInterface;
use App\Repositories\SessionYearsTrackings\SessionYearsTrackingsInterface;
use App\Repositories\SessionYearsTrackings\SessionYearsTrackingsRepository;
use Notification;

class RepositoryServiceProvider extends ServiceProvider {
    /**
     * Register services.
     *
     * @return void
     */
    public function register() {
        $this->app->bind(SchoolInterface::class, SchoolRepository::class);
        $this->app->bind(UserInterface::class, UserRepository::class);
        $this->app->bind(MediumInterface::class, MediumRepository::class);
        $this->app->bind(SubjectInterface::class, SubjectRepository::class);
        $this->app->bind(StaffInterface::class, StaffRepository::class);
        $this->app->bind(ClassSchoolInterface::class, ClassSchoolRepository::class);
        $this->app->bind(ClassSectionInterface::class, ClassSectionRepository::class);
        $this->app->bind(SectionInterface::class, SectionRepository::class);
        $this->app->bind(FormFieldsInterface::class, FormFieldsRepository::class);
        $this->app->bind(ClassSubjectInterface::class, ClassSubjectRepository::class);
        $this->app->bind(ElectiveSubjectGroupInterface::class, ElectiveSubjectGroupRepository::class);
        $this->app->bind(StudentInterface::class, StudentRepository::class);
        $this->app->bind(ExtraFormFieldsInterface::class, ExtraFormFieldsRepository::class);
        $this->app->bind(SubjectInterface::class, SubjectRepository::class);
        $this->app->bind(SubjectTeacherInterface::class, SubjectTeacherRepository::class);
        $this->app->bind(TimetableInterface::class, TimetableRepository::class);
        $this->app->bind(LessonsInterface::class, LessonsRepository::class);
        $this->app->bind(FilesInterface::class, FilesRepository::class);
        $this->app->bind(TopicsInterface::class, TopicsRepository::class);
        $this->app->bind(HolidayInterface::class, HolidayRepository::class);
        $this->app->bind(SlidersInterface::class, SlidersRepository::class);
        $this->app->bind(AnnouncementInterface::class, AnnouncementRepository::class);
        $this->app->bind(StudentSubjectInterface::class, StudentSubjectRepository::class);
        $this->app->bind(SessionYearInterface::class, SessionYearRepository::class);
        $this->app->bind(SessionYearsTrackingsInterface::class, SessionYearsTrackingsRepository::class);
        $this->app->bind(ExamInterface::class, ExamRepository::class);
        $this->app->bind(ExamTimetableInterface::class, ExamTimetableRepository::class);
        $this->app->bind(GradesInterface::class, GradesRepository::class);
        $this->app->bind(ExamMarksInterface::class, ExamMarksRepository::class);
        $this->app->bind(ExamResultInterface::class, ExamResultRepository::class);
        $this->app->bind(SystemSettingInterface::class, SystemSettingRepository::class);
        $this->app->bind(SchoolSettingInterface::class, SchoolSettingRepository::class);
        $this->app->bind(LanguageInterface::class, LanguageRepository::class);
        $this->app->bind(AttendanceInterface::class, AttendanceRepository::class);
        $this->app->bind(AssignmentInterface::class, AssignmentRepository::class);
        $this->app->bind(AssignmentSubmissionInterface::class, AssignmentSubmissionRepository::class);
        $this->app->bind(OnlineExamInterface::class, OnlineExamRepository::class);
        $this->app->bind(ClassTeachersInterface::class, ClassTeachersRepository::class);
        $this->app->bind(PromoteStudentInterface::class, PromoteStudentRepository::class);
        $this->app->bind(PackageInterface::class, PackageRepository::class);
        $this->app->bind(OnlineExamQuestionInterface::class, OnlineExamQuestionRepository::class);
        $this->app->bind(OnlineExamQuestionOptionInterface::class, OnlineExamQuestionOptionRepository::class);
        $this->app->bind(OnlineExamQuestionChoiceInterface::class, OnlineExamQuestionChoiceRepository::class);
        $this->app->bind(OnlineExamStudentAnswerInterface::class, OnlineExamStudentAnswerRepository::class);
        $this->app->bind(StudentOnlineExamStatusInterface::class, StudentOnlineExamStatusRepository::class);
        $this->app->bind(FeesTypeInterface::class, FeesTypeRepository::class);
        $this->app->bind(FeesClassTypeInterface::class, FeesClassTypeRepository::class);
        $this->app->bind(FeesInstallmentInterface::class, FeesInstallmentRepository::class);
        $this->app->bind(SemesterInterface::class, SemesterRepository::class);
        $this->app->bind(AnnouncementClassInterface::class, AnnouncementClassRepository::class);
        $this->app->bind(FeatureInterface::class, FeatureRepository::class);
        $this->app->bind(FeesInterface::class, FeesRepository::class);
        $this->app->bind(PackageFeatureInterface::class, PackageFeatureRepository::class);
        $this->app->bind(SubscriptionInterface::class, SubscriptionRepository::class);
        $this->app->bind(AddonInterface::class, AddonRepository::class);
        $this->app->bind(AddonSubscriptionInterface::class, AddonSubscriptionRepository::class);
        $this->app->bind(FeesPaidInterface::class, FeesPaidRepository::class);
        $this->app->bind(CompulsoryFeeInterface::class, CompulsoryFeeRepository::class);
        $this->app->bind(OptionalFeeInterface::class, OptionalFeeRepository::class);
        $this->app->bind(StreamInterface::class, StreamRepository::class);
        $this->app->bind(ShiftInterface::class, ShiftRepository::class);
        $this->app->bind(SubscriptionBillInterface::class, SubscriptionBillRepository::class);
        $this->app->bind(PaymentTransactionInterface::class, PaymentTransactionRepository::class);
        $this->app->bind(ExpenseInterface::class, ExpenseRepository::class);
        $this->app->bind(ExpenseCategoryInterface::class, ExpenseCategoryRepository::class);
        $this->app->bind(PaymentConfigurationInterface::class, PaymentConfigurationRepository::class);
        $this->app->bind(LeaveInterface::class, LeaveRepository::class);
        $this->app->bind(StaffSupportSchoolInterface::class, StaffSupportSchoolRepository::class);
        $this->app->bind(FaqsInterface::class, FaqsRepository::class);
        $this->app->bind(SubscriptionFeatureInterface::class, SubscriptionFeatureRepository::class);
        $this->app->bind(LeaveDetailInterface::class, LeaveDetailRepository::class);
        $this->app->bind(LeaveMasterInterface::class, LeaveMasterRepository::class);
        $this->app->bind(UserStatusForNextCycleInterface::class, UserStatusForNextCycleRepository::class);
        $this->app->bind(GuidanceInterface::class, GuidanceRepository::class);
        $this->app->bind(SubscriptionBillPaymentInterface::class, SubscriptionBillPaymentRepository::class);
        $this->app->bind(GalleryInterface::class, GalleryRepository::class);
        $this->app->bind(NotificationInterface::class, NotificationRepository::class);
        $this->app->bind(FeatureSectionInterface::class, FeatureSectionRepository::class);
        $this->app->bind(FeatureSectionListInterface::class, FeatureSectionListRepository::class);
        $this->app->bind(CertificateTemplateInterface::class, CertificateTemplateRepository::class);
        $this->app->bind(ClassGroupInterface::class, ClassGroupRepository::class);
        $this->app->bind(PayrollSettingInterface::class, PayrollSettingRepository::class);
        $this->app->bind(StaffSalaryInterface::class, StaffSalaryRepository::class);
        $this->app->bind(StaffPayrollInterface::class, StaffPayrollRepository::class);
        $this->app->bind(ChatInterface::class, ChatRepository::class);
        $this->app->bind(MessageInterface::class, MessageRepository::class);
        $this->app->bind(AttachmentInterface::class, AttachmentRepository::class);
        $this->app->bind(DatabaseBackupInterface::class, DatabaseBackupRepository::class);
        $this->app->bind(SchoolInquiryInterface::class, SchoolInquiryRepository::class);
        $this->app->bind(ExtraSchoolDataInterface::class, ExtraSchoolDataRepository::class);
        $this->app->bind(LessonsCommonInterface::class, LessonsCommonRepository::class);
        $this->app->bind(TopicCommonInterface::class, TopicCommonRepository::class);
        $this->app->bind(AssignmentCommonInterface::class, AssignmentCommonRepository::class);
        $this->app->bind(OnlineExamCommonInterface::class, OnlineExamCommonRepository::class);
        $this->app->bind(OnlineExamQuestionCommonInterface::class, OnlineExamQuestionCommonRepository::class);
        $this->app->bind(ContactInquiryInterface::class, ContactInquiryRepository::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot() {
        //
    }
}
