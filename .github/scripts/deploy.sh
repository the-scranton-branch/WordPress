#!/bin/bash

BASE_BRANCH=${GITHUB_REF##*/}
git remote add pantheon $pantheon_repo
git push -u pantheon HEAD:refs/heads/$BASE_BRANCH
terminus multidev:create $pantheon_site_name.live $BASE_BRANCH