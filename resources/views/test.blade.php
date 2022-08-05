//organizations service
..skills
..human_resource_skill --(skills_id)
..human_resource_template_skill --(skills_id)
..candidate_requirement_skill --index --(skills_id)
..hr_demand_skill --index
..industry_association_skill --(skills_id)
..services
..organization_unit_service --(services_id)
..organizations
..industry_association
..industry_association_organization --organizations_id --industry_association_id
..organizations_unit_type --organizations_id
..create_rank_types --organizations_id
..human_resource_template --organizations_id
..hr_demands --organizations_id
..organizations_sub_trade --organizations_id
..create_domains --organizations_id --industry_association_id
..primary_job_information --organizations_id --industry_association_id
..publications  --industry_association_id
..industry_association_member_landing_page_jobs --industry_association_id --organizations_id
..additional_job_information
..contact_info --index(industry_association_id)
..additional_job_information_job_levels
..additional_job_information_job_locations
..additional_job_information_other_benefit
..additional_job_information_work_places
..candidate_requirements
..candidate_requirement_professional_certifications --candidate_requirements
..candidate_requirement_area_of_experience --candidate_requirements --area_of_experiences
..candidate_requirement_area_of_business --candidate_requirements --area_of_business
..candidate_requirement_degrees --candidate_requirements
..candidate_requirement_trainings --candidate_requirements
..candidate_requirement_gender --candidate_requirements
..candidate_requirement_preferred_educational_institution --candidate_requirements
..area_of_business
..area_of_experiences
..matching_criteria --job_id
..applied_jobs --youth_id
..interview_schedules --recruitment_step
hr_demand_youths --youth_id --hr_demand_id
industry_association_skills  --skills_id
recruitment_steps --job_id
candidate_interviews --job_id
nascib_members
smef_members
four_ir_initiatives
four_ir_initiative_tots --four_ir_initiatives_id
four_ir_initiative_cells --four_ir_initiatives_id
four_ir_initiative_tna_formats --four_ir_initiatives_id
four_ir_initiative_cs_curriculum_cblm --four_ir_initiatives_id
four_ir_file_logs --four_ir_initiatives_id
four_ir_resources --four_ir_initiatives_id
four_ir_create_and_approves --four_ir_initiatives_id
four_ir_assessments --four_ir_initiatives_id
four_ir_showcasings --four_ir_initiatives_id
four_ir_employments --four_ir_initiatives_id
four_ir_scale_ups --four_ir_initiatives_id
four_ir_initiative_analysis --four_ir_initiatives_id
four_ir_contributions --four_ir_initiatives_id
four_ir_assign_team_member_to_initiatives --four_ir_initiatives_id
four_ir_occupations
four_ir_taglines
four_ir_tna_format_methods --four_ir_initiative_tna_formats_id
four_ir_cs_curriculum_cblm_experts --four_ir_initiative_cs_curriculum_cblm
four_ir_initiative_analysis_research_teams --four_ir_initiative_analysis_id
nascib_business_type_services --industry_association_id
four_ir_sectors
four_ir_initiative_tot_masters_trainers_participants --four_ir_initiative_tots
four_ir_contributions --four_ir_initiative_tots
four_ir_assign_team_member_to_initiatives --four_ir_initiatives_id
sectors
organization_sectors --sector_id,organizations_id
domain --organizations_id







